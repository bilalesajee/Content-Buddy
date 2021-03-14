<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\User;
use App\Item;
use App\Group;
use App\Label;
use App\Photo;
use App\Room;

class UserController extends Controller {

    protected $user_id = '';

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::id();
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function dashboard(Request $request) {
        $data['title'] = 'Dashboard';
        $user = Auth::user();
        $items_deatil = Item::where('user_id', $user->id)->with('ItemGroups.getGroupPhotos')->with('ItemPhotos')->get();
        $data['items_deatil'] = $items_deatil;
        $data['currentView'] = 'dashboard';
        return view('frontend', $data);
    }

    public function profileView() {
        $data['title'] = 'Profile';
        $data['currentView'] = 'profile';
        $data['user'] = $this->user;
        return view('frontend', $data);
    }

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|max:191',
                    'last_name' => 'required|max:191',
                    'image' => 'mimes:jpeg,png,jpg'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $user = User::where('id', $this->user_id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zip_code = $request->zip_code;
            if ($request->hasFile('image')) {
                $user->image = addFile($request->image, 'images/profile_images/');
            }
            $user->save();
            Session::flash('success', 'Account Updated successfully.');
            return redirect()->back();
        }
    }

    public function addItem(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
//                    'description' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return Response::json(array('success' => '0', 'message' => $errors));
        }
        $item = new Item();
        $item->user_id = $this->user_id;
        $item->title = $request->title;
//        $item->description = $request->description;
        $item->save();
        return Response::json(array('success' => '1', 'message' => 'Items added successfully'));
    }

    public function editItem(Request $request) {
        $item = Item::where('id', $request->item_id)->first();
        $item->title = $request->title;
//        $item->description = $request->description;
        $item->save();
        $data['status'] = true;
        return $data;
    }

    public function ItemDetailView($type, $id) {
        if (!isset(decodeId($id)[0])) {
            return redirect(url('/'));
        }
        $id = decodeId($id)[0];
        $data['room_list'] = Room::get();
        if ($type == 'group') {
            $group = Group::where('id', $id)->with('getGroupPhotos', 'getGroupLabel')->first();
            if(!$group){
                 return redirect('/user_dashboard');
            }
            $data['group'] = $group;
            $item = Item::where('id',$group->item_id)->first();
            if(!$item){
                 return redirect('/user_dashboard');
            }
            $data['group_name'] = $group->title;
            $data['item_name'] = $item->title;
            $data['item_id'] = $item->id;
            $data['photos_count'] = Photo::where('group_id', $id)->where('image_path', '!=', 'empty')->count();
            $data['title'] = 'Group Detail';
            $data['currentView'] = 'group_detail';
        } else {
            $photo = Photo::with('getLabel', 'getItems')->find($id);
            $data['item_name'] = $photo->getItems->title;
            $data['result'] = $photo;
            $data['title'] = 'Item Detail';
            $data['currentView'] = 'items_detail';
        }
        return view('frontend', $data);
    }

    function uploadGroupPhoto(Request $request) {
        
        if ($request->hasFile('group_image')) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
            $files = $request->file('group_image');
            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $photo = new Photo();
                    $photo->image_path = addFile($file, 'images/users_image/');
                    $photo->user_id = $this->user_id;
                    $photo->item_id = $request->item_id;
                    $photo->group_id = $request->group_id;
                    $photo->is_labeled = 1;
                    $photo->type = '2';
                    $photo->save();
                }
            }
        }

        $request->session()->flash('success', 'Images uploaded successfully.');
        return redirect(URL::previous());
    }

    function uploadItemPhoto(Request $request) {
        $edit_id = $request->edit_id;
        if ($request->hasFile('image')) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
            $file = $request->file('image');
            
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $photo = Photo::find($edit_id);
                $photo->image_path = addFile($request->image, 'images/users_image/');
                $photo->save();
            }
        }
        $request->session()->flash('success', 'Images uploaded successfully.');
        return redirect(URL::previous());
    }

    public function changePasswordView() {
        $data['title'] = 'Change Password';
        $data['currentView'] = 'change_password';
        return view('frontend', $data);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
                    'old_pass' => 'required',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            $old_password = $user->password;
            if ((Hash::check($request->get('old_pass'), Auth::user()->password))) {
                $new_password = bcrypt($request->password);
//                if ($old_password == $new_password) {
                if ((Hash::check($request->get('password'), Auth::user()->password))) {
                    $error_message = 'You can\'t set the new password as old password!';
                    Session::flash('error', $error_message);
                    return Redirect::back();
                }
                $password = $request->password;
                $user->password = bcrypt($password);
                $user->save();
                Session::flash('success', 'Password changed successfully!');
                return redirect('user_dashboard');
            } else {
                Session::flash('error', 'Incorect Old Password!');
                return redirect()->back();
            }
        }
    }

    function itemDetail(Request $request, $id) {
        if (!isset(decodeId($id)[0])) {
            return redirect(url('/'));
        }
       $id = decodeId($id)[0];
        $sort_by = $request->get('sort_by');
        $data['title'] = 'Items Detail';
        $data['item_id'] = $id;
        $data['sort_by'] = $sort_by;
        $item = Item::find($id);
        if(!$item){
            return redirect('/user_dashboard');
        }
        $data['result'] = array();
        $data['result_group'] = array();
        $data['tota_group'] = 0;
        $Item = Item::find($id);
        $data['item_name'] = $Item->title;
        $data['item_detail'] = $Item;
        if ($sort_by != 'group') {
            $data['result'] = Photo::with('getSingleLabel')->where('item_id', $id)
                            ->when($sort_by, function($query) use($sort_by) {
                                if ($sort_by == 'no_labeled') {
                                    $query->doesnthave('getLabel');
                                }
                                if ($sort_by == 'labeled') {
                                    $query->where('is_labeled' , 1);
                                }
                            })->whereNull('group_id')->get();
//                            })->whereNull('group_id')->get();
//                            dd($data['result']);
        }
        if ($sort_by != 'photos') {
            $get_group = Photo::with('getOneLabel.getGroup')
                            ->when($sort_by, function($query) use($sort_by) {
                                if ($sort_by == 'no_labeled') {
                                    $query->doesnthave('getOneLabel');
                                }
                                if ($sort_by == 'labeled') {
                                    $query->where('is_labeled' , 1);
                                }
                            })
                            ->select('*', DB::raw('count(*) as total_group_img'))
                            ->where('item_id', $id)
                            ->whereNotNull('group_id')
                            ->where('image_path', '!=', '')
//                            ->where('image_path', '!=', 'empty')
                            ->where('image_path', '!=', null)
                            ->groupBy('group_id')->get(); 
            $data['tota_group'] = $get_group->count();
            $data['result_group'] = $get_group;
        }


        //$result = array_merge($get_group->toArray(), $ungroup->toArray());

        $data['tota_photos'] = Photo::where('item_id', '=', $id)->where('image_path', '!=', 'empty')->count();
        $data['room_list'] = Room::get();
        $data['group_list'] = Group::where('item_id', $id)->get();

        $data['currentView'] = 'items_listing';
        return view('frontend', $data);
    }

    function addLabel(Request $request) {
        $validator = Validator::make($request->all(), [
                    'room_name' => 'required',
                    'item_name' => 'required',
                    'brand' => 'required',
                    'model' => 'required',
                    'serial_no' => 'required',
                    'quantity' => 'required',
                    'age_in_years' => 'required',
                    'age_in_months' => 'required',
                    'cost_to_replace' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return Response::json(array('success' => '0', 'message' => $errors));
        }

        $edit_id = $request->edit_id;
        $type_item = $request->type_item;

        if ($type_item != '' && $type_item == 'group') {
            $label = Label::where('group_id', $edit_id)->first();
            if ($label == null) {
                $label = new Label();
                $label->group_id = $edit_id;
            }
        } else {
            if ($edit_id) {
                $label = Label::find($edit_id);
            } else {
                $label = new Label();
                if ($request->image_id) {
                    $label->photo_id = $request->image_id;
                }
                $label->group_id = $request->group_id;
            }
        }
//        $room = Room::where('id', $request->room_id)->first();
        $photo = Photo::where('id', $request->image_id)->first();
        if($photo){
            $photo_labels = sizeof($photo->getLabel);
//            return Response::json($photo_labels);
                if($photo_labels > 0){
                    $photo->type = '1';
                }else{
                    $photo->is_labeled = 1;
                }
                $photo->save();
        }
//        $room_name = $room->title;
        $label->user_id = $this->user_id;
//        $label->room_id = $request->room_id;
//        $label->room_name = $room_name;
        $label->room_name = $request->room_name;
        $label->item_name = $request->item_name;
        $label->brand = $request->brand;
        $label->model = $request->model;
        $label->serial_no = $request->serial_no;
        $label->quantity = $request->quantity;
        $label->age_in_years = $request->age_in_years;
        $label->age_in_months = $request->age_in_months;
        $label->cost_to_replace = $request->cost_to_replace;
        $label->save();
        return Response::json(array('success' => '1', 'message' => 'label saved succcessfully'));
    }

    function editLabel(Request $request) {
        $label_id = $request->label_id;
        if ($label_id) {

            $label = Label::find($label_id);
        }
        if ($label) {
//            $room = Room::where('id', $request->room_id)->first();
//            $room_name = $room->title;
            $label->user_id = $this->user_id;
//            $label->room_id = $request->room_id;
//            $label->room_name = $room_name;
            $label->room_name = $request->room_name;
            $label->item_name = $request->item_name;
            $label->brand = $request->brand;
            $label->model = $request->model;
            $label->serial_no = $request->serial_no;
            $label->quantity = $request->quantity;
            $label->age_in_years = $request->age_in_years;
            $label->age_in_months = $request->age_in_months;
            $label->cost_to_replace = $request->cost_to_replace;
            $label->save();
//            return Response::json(array('success' => '1', 'message' => 'label updated succcessfully'));
            Session::flash('success', 'label updated succcessfully');
            return Redirect::to(URL::previous());
        } else {
            Session::flash('error', 'label not updated');
            return Redirect::to(URL::previous());
        }
    }

    function addPhotos(Request $request) {
//        return Response::json($request->all());
        $type = $request->type;
        $group_id = $request->group_id;
        if ($type == 'single') {
            $rules = [
//                'room_id' => 'required|max:191',
                'room_name' => 'required|max:191',
                'item_name' => 'required|max:191',
                'brand' => 'required|max:191',
                'model' => 'required|max:191',
                'serial_no' => 'required|max:191',
                'quantity' => 'required|max:191',
                'cost_to_replace' => 'required|max:191',
                'age_in_years' => 'required|max:191',
                'age_in_months' => 'required|max:191',
            ];
        } else if ($type == 'multi') {
            $rules = [
                'group_image' => 'required',
            ];
        } else if ($type == 'group') {
            if ($group_id == '-1') {
                $rules = [
                    'group_title' => 'required|max:191|unique:groups,title',
//                    'group_image' => 'required|unique:groups,title',
//                    'room_id' => 'required|max:191',
                    'room_name' => 'required|max:191',
                    'item_name' => 'required|max:191',
                    'brand' => 'required|max:191',
                    'model' => 'required|max:191',
                    'serial_no' => 'required|max:191',
                    'quantity' => 'required|max:191',
                    'cost_to_replace' => 'required|max:191',
                    'age_in_years' => 'required|max:191',
                    'age_in_months' => 'required|max:191',
                ];
            } else {
                $rules = [
                    'group_id' => 'required'
                ];
                $message = 'Images uploaded successfully';
            }
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return Response::json(array('success' => '0', 'message' => $errors));
        }
        $label = new Label();
        $type = $request->type;
        $add_group_id = $request->group_id;
        $message = 'Label Saved successfully';
        if ($type == 'group') {
            $group_id = $request->group_id;
            if ($group_id == '-1') {
                
                $create_group = New Group();
                $create_group->title = $request->group_title;
                $create_group->user_id = $this->user_id;
                $create_group->item_id = $request->item_id;
                $create_group->save();
                $add_group_id = $create_group->id;
                
//                $room = Room::where('id', $request->room_id)->first();
//                $room_name = $room->title;
                $label->group_id = $add_group_id;
                $label->user_id = $this->user_id;
//                $label->room_id = $request->room_id;
//                $label->room_name = $room_name;
                $label->room_name = $request->room_name;
                $label->item_name = $request->item_name;
                $label->brand = $request->brand;
                $label->model = $request->model;
                $label->serial_no = $request->serial_no;
                $label->quantity = $request->quantity;
                $label->age_in_years = $request->age_in_years;
                $label->age_in_months = $request->age_in_months;
                $label->cost_to_replace = $request->cost_to_replace;
                $label->save();
            } else {
//                $label->user_id = $this->user_id;
//                $label->group_id = $add_group_id;
//                $label->save();
            }
            if ($request->hasFile('group_image')) {
                
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $files = $request->file('group_image');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $photo = new Photo();
                        $photo->image_path = addFile($file, 'images/users_image/');
                        $photo->user_id = $this->user_id;
                        $photo->item_id = $request->item_id;
                        $photo->group_id = $add_group_id;
                        $photo->is_labeled = 1;
                        $photo->type = '2';
                        $photo->save();
                    }
                }
            }else{
                $photo = new Photo();
                        $photo->image_path = 'empty';
                        $photo->user_id = $this->user_id;
                        $photo->item_id = $request->item_id;
                        $photo->group_id = $add_group_id;
                        $photo->is_labeled = 1;
                        $photo->type = '2';
                        $photo->save();
            }
        } if ($type == 'multi') {
            if ($request->hasFile('group_image')) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $files = $request->file('group_image');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $photo = new Photo();
                        $photo->image_path = addFile($file, 'images/users_image/');
                        $photo->user_id = $this->user_id;
                        $photo->item_id = $request->item_id;
                        $photo->is_labeled = 0;
                        $photo->type = '0';
                        $photo->save();
                    }
                }
            }
            $message = 'Images saved successfully';
        } else {
            if ($request->hasFile('image')) {
                $photo = new Photo();
                $photo->image_path = addFile($request->image, 'images/users_image/');
                $photo->user_id = $this->user_id;
                $photo->item_id = $request->item_id;
                $photo->is_labeled = 1;
                $photo->type = '0';
                $photo->save();
                $label->photo_id = $photo->id;
            }
//            $room = Room::where('id', $request->room_id)->first();
//            $room_name = $room->title;
            $label->user_id = $this->user_id;
//            $label->room_id = $request->room_id;
//            $label->room_name = $room_name;
            $label->room_name = $request->room_name;
            $label->item_name = $request->item_name;
            $label->brand = $request->brand;
            $label->model = $request->model;
            $label->serial_no = $request->serial_no;
            $label->quantity = $request->quantity;
            $label->age_in_years = $request->age_in_years;
            $label->age_in_months = $request->age_in_months;
            $label->cost_to_replace = $request->cost_to_replace; 
            $label->save();
        }
        return Response::json(array('success' => '1', 'message' => $message));
    }

    function addToGroup(Request $request) {
        $group_id = $request->group_id;
        $items_ids = $request->items_ids;
        $selected_ids = json_decode($items_ids);
        if (!$selected_ids) {
            $result = array('success' => 0, 'message' => 'Iteme not found!');
            echo json_encode($result);
        }
        //Remove current label photos
        Label::whereIn('photo_id', $selected_ids)->delete();

        if ($group_id == '-1') {
            //Create new group and label
            $validator = Validator::make($request->all(), [
                        'group_name' => 'required|unique:groups,title',
                        'room_name' => 'required',
                        'item_name' => 'required',
                        'brand' => 'required',
                        'model' => 'required',
                        'serial_no' => 'required',
                        'quantity' => 'required',
                        'age_in_years' => 'required',
                        'age_in_months' => 'required',
                        'cost_to_replace' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = implode('<br>', $validator->errors()->all());
                return Response::json(array('success' => 0, 'message' => $errors));
            }

            $new_group = new Group();
            $new_group->title = $request->group_name;
            $new_group->user_id = Auth::id();
            $new_group->item_id = $request->item_id;
            $new_group->save();
            $group_id = $new_group->id;

            //Create new group label
//            $room = Room::where('id', $request->room_id)->first();
//            $room_name = $room->title;

            $label = New Label();
            $label->user_id = $this->user_id;
            $label->group_id = $group_id;
//            $label->room_id = $request->room_id;
//            $label->room_name = $room_name;
            $label->room_name = $request->room_name;
            $label->item_name = $request->item_name;
            $label->brand = $request->brand;
            $label->model = $request->model;
            $label->serial_no = $request->serial_no;
            $label->quantity = $request->quantity;
            $label->age_in_years = $request->age_in_years;
            $label->age_in_months = $request->age_in_months;
            $label->cost_to_replace = $request->cost_to_replace;
            $label->save();
        }

        Photo::whereIn('id', $selected_ids)->update(['group_id' => $group_id,'is_labeled' => 1,'type' => '2']);
        $result = array('success' => 1, 'message' => 'Items added to group successfully!');

        echo json_encode($result);
    }

    function mangeGroups() {
        $data['title'] = 'Manage items';
        $data['result'] = Group::where('user_id', Auth::id())->get();
        $data['items_list'] = Item::where('user_id', Auth::id())->get();
        $data['currentView'] = 'manage_groups';
        return view('frontend', $data);
    }

    function addGroup(Request $request) {
//        $edit_id = $request->edit_id;
//        if ($edit_id) {
//            $group = Group::find($edit_id);
//        } else {
//        }
        $group = new Group();
        $group->item_id = $request->item_id;
        $group->user_id = Auth::id();
        $group->title = $request->title;
        $group->save();
        return Response::json(array('success' => '1', 'message' => 'Group saved succcessfully'));
    }

    public function deleteItem(Request $request) {

        Item::where('id', $request->item_id)->where('user_id' , Auth::id())->delete();
//        Item::where('id', $request->item_id)->delete();
    }

    public function deleteRecord(Request $request) {
//        echo json_encode($request->all());
        $id = $request->id;
        $table = $request->table;

        switch ($table) {
            case 'label':
                Label::where('id', $id)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;

            case 'groups':
                Group::where('id', $id)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;

            case 'groups_photos':
                Group::where('id',$id)->delete();
                Photo::where('group_id', $id)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;

            case 'list_detail':
                Photo::where('id', $id)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;

            case 'multi_label':
                $ids = json_decode($id, true)['id'];
                Photo::whereIn('id', $ids)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;
            case 'photo_with_group':
                $ids = json_decode($id, true)['id'];
                $group_ids= Photo::select('group_id')->whereIn('id', $ids)->where('type', '2')->get()->toArray();
                $photos = Photo::whereIn('id', $ids)->delete();
                $photos = Photo::whereIn('group_id', $group_ids)->delete();
                Group::whereIn('id', $group_ids)->delete();
                $result = array('success' => '1', 'message' => 'Record has been deleted successfully!');
                echo json_encode($result);
                break;
            default:
                return redirect()->back();
        }
    }

}
