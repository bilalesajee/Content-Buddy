<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\User;
use App\Admin;
use App\Blog;
use App\Item;
use App\Group;
use App\Label;
use App\Room;
use App\Photo;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PDF;

class AdminManagementController extends Controller {

    public $data = array();

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->data['data'] = Auth()->guard('admin')->user();
            return $next($request);
        });
    }

    public function exportFile() {
        $data = User::all()->toArray();

        $sheet = new \Laracsv\Export();
        $sheet->build(User::get(), ['email', 'name' => 'Full Name', 'created_at' => 'Joined'], function() {
            $sheet->setStyle(array(
                'font' => array(
                    'name' => 'Calibri',
                    'size' => 15,
                    'bold' => true
                )
            ));
        });



        $sheet->download();
    }

    public function addRoom($id = '', $clone = '') {
        $this->data['currentView'] = "add_room";
        $this->data['tab'] = 'room';
        $this->data['title'] = 'Add Room';
        if ($id) {
            $this->data['result'] = Room::find($id);

            if ($clone != '') {
                $this->data['title'] = 'Copy Room';
            } else {
                $this->data['title'] = 'Edit Room';
            }

            $this->data['edit_id'] = $id;
        }
        return view('admin_template', $this->data);
    }

    public function postRoom(Request $request) {
        $edit_id = $request->edit_id;
        $clone = $request->clone;

        if (!isset($edit_id) || $edit_id == '') {
            $rules['title'] = 'required|max:15|unique:rooms';
        } if (isset($edit_id) && $edit_id != '' && isset($clone) && $clone != '') {
            $rules['title'] = 'required|unique:rooms';
        } else {
            $rules['title'] = 'required|max:15|unique:users,username,' . $edit_id;
        }
        $request->validate($rules);

        if ($edit_id && $clone == '') {
            $user = Room::find($edit_id);
        } else {
            $user = New Room();
        }
        $user->title = $request->title;
        $user->save();
        $request->session()->flash('success', 'Record saved successfully.');
        return redirect('manage_rooms');
    }

    public function manageRooms() {
        $this->data['currentView'] = "manage_rooms";
        $this->data['title'] = 'Manage Room';
        $this->data['tab'] = 'room';
        $this->data['result'] = Room::orderBy('updated_at','DESC')->get();
//        dd($this->data['result']);
        return view('admin_template', $this->data);
    }

    //User module
    public function editAdjuster($user_id = '') {
        $this->data['currentView'] = "edit_adjuster";
        $this->data['tab'] = 'user';
        $this->data['title'] = 'Add User';
        $this->data['type'] = 'adjuster';
        if ($user_id) {
            $this->data['result'] = Admin::find($user_id);
             $this->data['title'] = 'Edit User'; 
            $this->data['edit_id'] = $user_id;
        }
        return view('admin_template', $this->data);
    }
    public function addUser($user_id = '', $clone = '') {
        $this->data['currentView'] = "add_user";
        $this->data['tab'] = 'user';
        $this->data['title'] = 'Add User';
        $this->data['type'] = 'user';
        if ($user_id) {
            $this->data['result'] = User::find($user_id);
            if ($user_id != '') {
                $this->data['title'] = 'Edit User';
            } else {
                $this->data['title'] = 'Copy User';
            }
            $this->data['edit_id'] = $user_id;
        }
        return view('admin_template', $this->data);
    }

    public function postUser(Request $request) {
        $rules = [
            'first_name' => 'required|max:50',
            'last_name' => 'required',
            'image' => 'image'
        ];
        $edit_id = $request->edit_id;
        $clone = $request->clone;
        $request->type = 'user';
        $type = $request->type;
        $type = 'user';

        if (!isset($edit_id) || $edit_id == '') {

            $rules['password'] = 'required|min:6';
            if ($type == 'user') {
                $rules['email'] = 'required|unique:users';
//                $rules['username'] = 'required|max:50|unique:users';
            } else {
//                $rules['email'] = 'required|unique:admins';
//                $rules['username'] = 'required|max:50|unique:admins';
            }
        } if (isset($edit_id) && $edit_id != '') { 
            if ($type == 'user') {
//                $rules['email'] = 'required|unique:admins';
//                $rules['email'] = 'sometimes|required|email|unique:users';
            } else {
                $rules['email'] = 'sometimes|required|email|unique:users';
            }
        } else {
            if ($type == 'user') {
                $rules['email'] = 'required|unique:users,email,' . $edit_id;
//                $rules['username'] = 'required|max:15|unique:users,username,' . $edit_id;
            } else {
                $rules['email'] = 'required|unique:admins,email,' . $edit_id;
//                $rules['username'] = 'required|max:15|unique:admins,username,' . $edit_id;
            }
        }
         $customMessages = [
        'image' => 'Please select jpg,jpeg or png file.'
    ];

    $this->validate($request, $rules, $customMessages);
//        $request->validate($rules);
        if ($type == 'user') {
            if ($edit_id) {
                $user = User::find($edit_id);
                $old_file = $user->image;
            } else {
                $user = New User();
            }
        } else {
            if ($edit_id) {
                $user = Admin::find($edit_id);
                $old_file = $user->image;
            } else {
                $user = New Admin();
            }
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->full_name =$request->first_name.' '.$request->last_name;
        $user->type = 'user';
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        if ($type == 'user') {
            $user->is_active = 1;
            $user->is_approved_by_admin = 1;
        }
        if ($request->change_password) {
            $user->password = Hash::make($request->change_password);
        } else if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(100, 100);
            $file_path = public_path('images/users_image/');
            $image_resize->save($file_path . $filename);
            $save_path = 'images/users_image/' . $filename;
            $user->image = $save_path;
        }

        $user->save();
        
        $request->session()->flash('success', 'Record saved successfully.');
        if ($request->type == 'user') {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function manageUsers($type='') {
        $this->data['currentView'] = "manage_users";
        $this->data['title'] = 'Manage Users';
        $this->data['tab'] = 'user';
        $this->data['type'] = 'users';
        $this->data['result'] = User::where('type', 'user')->orderBy('updated_at', 'DESC')->get();
        $filter = '';
        if($type == 'active'){
            $filter = 1;
            $this->data['title'] = 'Active Users';
        }
        if($type == 'inactive'){
            $filter = '0';
            $this->data['title'] = 'Inactive Users';
        }
        if($type == 'blocked'){
            $filter = '2';
            $this->data['title'] = 'Blocked Users';
        }
        $this->data['result'] = User::where('type', 'user')->where(function($q)use($filter){
                    if ($filter == 1) {
                        $q->where('is_blocked',0)->where('is_approved_by_admin',1);
                    }
                    if ($filter == '0') {
                        $q->where('is_approved_by_admin', $filter);
                    }
                    if ($filter == '2') {
                        $q->where('is_blocked',1);
                    }
                })->orderBy('updated_at', 'DESC')->get();
        $this->data['filter'] = $filter;
        return view('admin_template', $this->data);
    }

    public function manageAdjuster() {
        $this->data['currentView'] = "manage_adjuster";
        $this->data['title'] = 'Manage Adjuster';
        $this->data['tab'] = 'user';
        $this->data['type'] = 'adjuster';
        $this->data['result'] = Admin::where('type', 'adjuster')->get();
        return view('admin_template', $this->data);
    }

    public function addItems($user_id = '',$item_id = '', $clone = '') {
        $this->data['currentView'] = "add_items";
        $this->data['tab'] = 'items';
        $this->data['title'] = 'Add Room';
//        $this->data['title'] = 'Add Item';
        if($user_id){
            $this->data['user_id'] = $user_id;
        }else{
            return redirect('dashboard');
        }
//        $this->data['users'] = User::where(['is_active' => 1, 'type' => 'user'])->get();
//        $user = User::where('id',$user_id)->first();
        $Item = Item::where('id',$item_id)->first();
        if ($Item) {
            $this->data['result'] = Item::where('id',$item_id)->first();

            if ($clone != '') {
                $this->data['title'] = 'Copy Item';
            } else {
                $this->data['title'] = 'Edit Item';
            }

            $this->data['edit_id'] = $item_id;
        }
        return view('admin_template', $this->data);
    }

    public function postItems(Request $request) {
        $rules = [
            'user_id' => 'required',
            'title' => 'required'
//            'description' => 'required'
        ];
        $edit_id = $request->edit_id;
//        $clone = $request->clone;
        $request->validate($rules);
        if ($edit_id) {
            $item = Item::find($edit_id);
            $request->session()->flash('success', 'Item Edited Successfully.');
        } else {
            $item = New Item();
            $request->session()->flash('success', 'New Item Added Successfully.');
        }
        $item->user_id = $request->user_id;
        $item->title = $request->title;
//        $item->description = $request->description;

        $item->save();
        return redirect('manage_items/'.$item->user_id);
    }

//    public function adminDeleteItem($user_id = '',$item_id = '') {
//        $item = Item::find($item_id);
//        if($item){
//            $item->delete();
//            session()->flash('success', 'Item deleted successfully.');
//            return redirect('manage_items/'.$item->user_id);
//        }else{
//            $request->session()->flash('error', 'Item not found.');
//            return redirect('manage_items/'.$item->user_id);
//        }
//    }
    
    public function userItems(Request $request, $id) {

        $this->data['currentView'] = "manage_items";
        $this->data['title'] = 'Manage Items';
        $this->data['tab'] = 'user';
        $this->data['users'] = User::where(['is_active' => 1, 'type' => 'user'])->get();
        $this->data['user'] = User::find($id);
        $this->data['result'] = Item::with('getUser')->whereHas('getUser', function($query) use($id) {
                    $query->where('user_id', $id);
                })->get();
        return view('admin_template', $this->data);
    }

    public function manageItems(Request $request, $id = '') {

        $this->data['currentView'] = "manage_items";
        $this->data['title'] = 'Manage Rooms';
        $this->data['tab'] = 'user';
        $this->data['user_id'] = $id;
        $this->data['users'] = User::where(['is_active' => 1, 'type' => 'user'])->get();
        if(!$id){
            return redirect('/manage_users');
        }
        $this->data['user_id'] = $id;
        $this->data['result'] = Item::with('getUser')->whereHas('getUser', function($query) use($id) {
                    if ($id) {
                        $query->where('user_id', $id);
                    }
                })->get();
        return view('admin_template', $this->data);
    }

    public function viewItem($id) {
        $this->data['currentView'] = "view_item";
        $this->data['title'] = 'View Room';
        $this->data['tab'] = 'item';
        $single_photos = Photo::select('id')->where('item_id', $id)->where('type', '0')->orderBy('updated_at')->get()->toArray();
        $label_photos = Photo::select('id')->where('item_id', $id)->where('type', '1')->orderBy('updated_at')->get()->toArray();
        $group_photos = Photo::select('id')->groupBy('group_id')->where('item_id', $id)->where('image_path','!=','empty')->where('type', '2')->orderBy('updated_at')->get()->toArray();
        $all_photos = array_merge($single_photos, $label_photos);
        $get_photos = array_merge($all_photos, $group_photos);
//        dd($get_photos);
        $Items = Item::where('id', $id)
                ->with(array('ItemAllPhotos' => function($query) use($get_photos) {
                        $query->whereIn('id', $get_photos);
                        $query->with('getLabel', 'getGroup.getLabel', 'getGroup.getGroupPhotos');
                    }))
//                ->with('ItemAllPhotos.getLabel','ItemAllPhotos.getGroup.getLabel','ItemAllPhotos.getGroup.getGroupPhotos')
                ->with('ItemSinglePhotos')
                ->with('ItemGroups')
                ->orderBy('updated_at')
                ->first();
        $this->data['result'] = $Items;
        $this->data['item_id'] = $id;
        $this->data['user_id'] = Photo::select('user_id')->where('item_id', $id)->first();
//        $this->data['result'] = Item::with('getUser', 'ItemAllPhotos')->find($id);
        return view('admin_template', $this->data);
    }

    public function downloadXlsFile(Request $request) {
        ////start code for getting xls/csv template and append data from database in it/////
        //getting data
        $id = $request->id;
        $type = $request->type;
        $claim_no = $request->claim_no;
        $state = $request->state;
        $policy_no = $request->policy_no;
        $information = $request->information;

        if($type == 'xact') {
            $path = public_path('sample_file/test.xls');
            $labels = Label::where('user_id', $id)->get();
            if ($labels->isEmpty()) {
                $request->session()->flash('error', 'Record not found.');
                return redirect()->back();
            }
            $user = User::where('id', $id)->first();
            $user_name = $user->full_name; //setting file name
            $file_name = $user_name . '_ClaimedContent' . time();
            ///getting or loading template in which we want to put data
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setCellValue('E2', $user_name);
            $worksheet->setCellValue('H2', $claim_no);
            $worksheet->setCellValue('H3', $policy_no);
            $worksheet->setCellValue('K3', $state);
            $worksheet->setCellValue('D4', $information);

            $counter = 9;
            foreach ($labels as $label) {
                //specifying cells for putting data in them
                $worksheet->setCellValue('B' . $counter . '', $label->room_name);
                $worksheet->setCellValue('C' . $counter . '', $label->brand);
                $worksheet->setCellValue('D' . $counter . '', $label->model);
                $worksheet->setCellValue('E' . $counter . '', $label->item_name);
                $worksheet->setCellValue('F' . $counter . '', $label->quantity);
                $worksheet->setCellValue('G' . $counter . '', $label->age_in_years);
                $worksheet->setCellValue('H' . $counter . '', $label->age_in_months);
                $worksheet->setCellValue('J' . $counter . '', $label->cost_to_replace);
                $counter++;
            }
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            //setting headers to save file in our downloads directory
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $file_name . '.xls"');
            header("Content-Transfer-Encoding: binary");
            $writer->save("php://output");
            ////end code for getting xls/csv template and append data from database in it/////
            return redirect()->back();
        } else if ($type == 'simsol') {
            
//            $result = Photo::with('getLabel.getRoom', 'getItems')->where('user_id', $id)->get();
            $result = Label::where('user_id', $id)->get();
//            dd($result);
            if($result->isEmpty()){
                $request->session()->flash('error', 'No Record Found.');
                return redirect()->back();
            }
            $unique_name = time();
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=" . $unique_name . "_items.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('Item#', 'Room', 'Brand Or Manufacturer ', 'Model#', 'Serial Number', 'Quantity Lost', 'Item Age (Years)', 'Item Age (Month)', 'Cost to Replace Pre-Tax (each)', 'Total Cost');

            $callback = function() use ($result, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                $count = 1;
                foreach ($result as $labels) {
                            $columns_data = array();
                            $columns_data[] = $count;
                            $columns_data[] = $labels->room_name;
                            $columns_data[] = $labels->brand;
                            $columns_data[] = $labels->model;
                            $columns_data[] = $labels->serial_no;
                            $columns_data[] = $labels->quantity;
                            $columns_data[] = $labels->age_in_years;
                            $columns_data[] = $labels->age_in_months;
                            $columns_data[] = $labels->cost_to_replace;
                            $total = ($labels->quantity * $labels->cost_to_replace);
                            $columns_data[] = round($total, 2);
                            $count++;
                            fputcsv($file, $columns_data);
                }
                fclose($file);
            };
            return Response::stream($callback, 200, $headers);
        }
        else if($type == 'photo'){
            $data['contents'] = Photo::with('getLabel')->with('getGroup.getGroupLabel')->where('user_id', $id)->where('is_labeled', 1)->get();
//            dd($data);
            $pdf = PDF::loadView('admin.pdf', $data);
            return $pdf->stream('document.pdf');
            $request->session()->flash('success', 'PDF created.');
            return redirect()->back();
        } else{
            $request->session()->flash('error', 'Please Select Download Type,In Which Format You Want to Download the File.');
            return redirect()->back();
        }
    }
    
    
    public function approveUser(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $type = $request->type;
        $type_user = ($type == 'adjuster')?'Adjuster':'User';
        if($type == 'users') { 
        $user = User::find($id);
        } else {
        $user = Admin::find($id);
            
        }
        $user->is_approved_by_admin = $status;
        $user->save();
        if ($status == 1) {
             
            $message = $type_user.' Approved successfully';
        } else {
            $message = $type_user.' Blocked successfully';
        }
        $result = array('success' => 1, 'message' => $message);
        echo json_encode($result);
    }
    
    public function blockUser(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $type = $request->type;
        $type_user = ($type == 'adjuster')?'Adjuster':'User';
        if($type == 'users') { 
        $user = User::find($id);
        } else {
        $user = Admin::find($id);
            
        }
        $user->is_blocked = $status;
        $user->save();
        if ($status == 1) {
             
            $message = $type_user.' Blocked successfully';
        } else {
            $message = $type_user.' Unblocked successfully';
        }
        $result = array('success' => 1, 'message' => $message);
        echo json_encode($result);
    }
    

    public function downloadFile($id) {
        $result = Photo::with('getLabel.getRoom', 'getItems')->where('user_id', $id)->get();
            
        $unique_name = time();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $unique_name . "_items.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array('Item#', 'Room', 'Brand Or Manufacturer ', 'Model#', 'Item Description', 'Quantity Lost', 'Item Age (Years)', 'Item Age (Month)', 'Cost to Replace Pre-Tax (each)', 'Total Cost');

        $callback = function() use ($result, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $count = 1;
            foreach ($result as $list) {
                if ($list->getLabel) {
                    foreach ($list->getLabel as $labels) {
                        $columns_data = array();
                        $columns_data[] = $count;
                        $columns_data[] = $labels->getRoom->title;
                        $columns_data[] = $labels->brand;
                        $columns_data[] = $labels->model;
                        $columns_data[] = $list->getItems->description;
                        $columns_data[] = $labels->quantity;
                        $columns_data[] = $labels->age_in_years;
                        $columns_data[] = $labels->age_in_months; 

                        $columns_data[] = $labels->cost_to_replace;
                        $total = ($labels->quantity*$labels->cost_to_replace);
                        $columns_data[] = round($total,2);
                        $count++;
                        fputcsv($file, $columns_data);
                    }
                }
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    /**     * Export Data* * */
    public function export() {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $reviews = Reviews::getReviewExport($this->hw->healthwatchID)->get();
        $columns = array('ReviewID', 'Provider', 'Title', 'Review', 'Location', 'Created', 'Anonymous', 'Escalate', 'Rating', 'Name');
        $callback = function() use ($reviews, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reviews as $review) {
                fputcsv($file, array($review->reviewID, $review->provider, $review->title, $review->review, $review->location, $review->review_created, $review->anon, $review->escalate, $review->rating, $review->name));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

//    Groups function
    public function addGroup($id = '', $clone = '') {

        $this->data['currentView'] = "add_group";
        $this->data['tab'] = 'group';
        $this->data['title'] = 'Add Group';
        $this->data['users'] = User::with('userItems')->where(['is_active' => 1, 'type' => 'user'])->get();
 
        if ($id) {
            $this->data['result'] = Group::with('getUser')->find($id); 
            if ($clone != '') {
                $this->data['title'] = 'Copy Group';
            } else {
                $this->data['title'] = 'Edit Group';
            }

            $this->data['edit_id'] = $id;
        }
        return view('admin_template', $this->data);
    }

    public function postGroup(Request $request) {
        $rules = [
            'user_id' => 'required',
            'title' => 'required',
            'item_id' => 'required'
        ];
        $edit_id = $request->edit_id;
        $clone = $request->clone;
        $request->validate($rules);
        if ($edit_id && $clone == '') {
            $group = Group::find($edit_id);
        } else {
            $group = New Group();
        }
        $group->user_id = $request->user_id;
        $group->item_id = $request->item_id;
        $group->title = $request->title;

        $group->save();
        $request->session()->flash('success', 'Record saved successfully.');
        return redirect('manage_groups');
    }

    public function viewGroup($id) {
        $this->data['currentView'] = "view_group";
        $this->data['title'] = 'View Group';
        $this->data['tab'] = 'group';
        $this->data['result'] = Group::with('getUser', 'getItem', 'getLabel.getRoom')->find($id);
        return view('admin_template', $this->data);
    }

    public function manageGroup() {
        $this->data['currentView'] = "manage_group";
        $this->data['title'] = 'Manage Group';
        $this->data['tab'] = 'group';
        $this->data['result'] = Group::with('getUser', 'getItem')->get();
        return view('admin_template', $this->data);
    }

    public function managePhotos() {
        $this->data['currentView'] = "manage_photos";
        $this->data['title'] = 'Manage Photos';
        $this->data['tab'] = 'photo';
        $this->data['result'] = Photo::with('getUser', 'getLabel')->get();
        return view('admin_template', $this->data);
    }

    public function viewPhotos($id) {
        $this->data['currentView'] = "view_photo";
        $this->data['title'] = 'Manage Photos';
        $this->data['tab'] = 'photo';
        $this->data['result'] = Photo::with('getUser', 'getLabel')->find($id);
//        dd($this->data['result']);  
        return view('admin_template', $this->data);
    }
    
    public function LabelView() {
        $this->data['currentView'] = "add_label";
        $this->data['tab'] = 'label';
        if(isset($_GET['photo_id'])){
            $photo_id = $_GET['photo_id'];
            $this->data['photo_id'] = $photo_id;
            $label = Label::where('photo_id',$photo_id)->get();
            if(!$label->isEmpty()){
                $this->data['label'] = $label;
                $this->data['edit_label'] = 1;
                $this->data['title'] = 'Edit Label';
            }else{
                $this->data['edit_label'] = 0;
                $this->data['title'] = 'Add Label';
            }
            $photo = Photo::where('id',$photo_id)->first();
        }else if(isset($_GET['group_id'])){
            $photo_id = $_GET['group_id'];
            $photo = Photo::where('id',$photo_id)->first();
            $this->data['group_id'] = $photo->group_id;
            $label = Label::where('group_id',$photo->group_id)->get();
            if($label){
                $this->data['label'] = $label;
                $this->data['edit_label'] = 1;
                $this->data['title'] = 'Edit Group Label';
            }else{
                $this->data['edit_label'] = 0;
                $this->data['title'] = 'Add Group Label';
            }
        }else{
            return redirect('/dashboard');
        }
//        $this->data['users'] = User::where(['is_active' => 1, 'type' => 'user'])->get();
        if(isset($photo)){
            $this->data['user_id'] = $photo->user_id;
            $this->data['item_id'] = $photo->item_id;
        }
        $this->data['rooms'] = Room::orderBy('created_at','desc')->get();
//        dd($this->data);
        return view('admin_template', $this->data);
    }

    public function submitLabel(Request $request) {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
//                    'photo_id' => 'required',
//                    'room_id' => 'required',
                    'item_name' => 'required',
                    'brand' => 'required',
                    'model' => 'required',
                    'quantity' => 'required',
                    'age_in_years' => 'required',
                    'age_in_months' => 'required|max:12'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->room_id) {
            $room = Room::where('id', $request->room_id)->first();
            if ($room) {
                $room_name = $room->title;
            } else {
                $request->session()->flash('error', 'There is somne error in room selection.');
                return redirect()->back()->withInput();
            }
        }
        if($request->edit_label == 1 && $request->label_id != null){
                $label = Label::where('id',$request->label_id)->where('user_id',$request->user_id)->first();
            }else if($request->edit_label == 1 && $request->photo_id != null){
                $label = Label::where('id',$request->label_id)->where('user_id',$request->user_id)->first();
            }else if($request->edit_label == 0){
                $label = new Label();
            }else{
                $request->session()->flash('success', 'some error has been occurred.');
                return redirect()->back()->withInput();
            }
            $label->user_id = $request->user_id;
            $label->photo_id = $request->photo_id;
            $label->group_id = $request->group_id;
            if($request->room_id) {
                $label->room_id = $request->room_id;
                $label->room_name = $room_name;
            }
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
            if($request->photo_id){
                $photo = Photo::where('id',$request->photo_id)->first();
                $photo->is_labeled = 1;
                $photo->save();
            }
            $request->session()->flash('success', 'Label has been updated.');
            return redirect()->back();    
    }
    
//    public function editLabelView() {
//        $this->data['currentView'] = "edit_label";
//        $this->data['title'] = 'Edit Label';
//        $this->data['tab'] = 'label';
//        
//        $this->data['rooms'] = Room::all();
//        
//        return view('admin_template', $this->data);
//    }
//    
//    public function editLabel(Request $request) {
//        dd($request->all());
//    }
    
    public function updateStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $type = $request->type;
        $type_user = ($type == 'adjuster')?'Adjuster':'User';
        if($type == 'users') { 
        $user = User::find($id);
        } else {
        $user = Admin::find($id);
            
        }
        $user->is_active = $status;
        $user->save();
        if ($status == 1) {
             
            $message = $type_user.' activated successfully';
        } else {
            $message = $type_user.' inactivated successfully';
        }
        $result = array('success' => 1, 'message' => $message);
        echo json_encode($result);
    }

    public function deleteItem(Request $request) {
        $id = $request->id;
        $table = $request->table;
        if ($table == 'item') {
            Item::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'Item has been deleted successfully!');
        }
        if ($table == 'users') {
            User::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'User has been deleted successfully!');
        }
        if ($table == 'adjuster') {
            Admin::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'Adjuster has been deleted successfully!');
        }
        if ($table == 'label') {
            Label::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'Label has been deleted successfully!');
        }
        if ($table == 'room') {
            Room::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'Room has been deleted successfully!');
        }
        if ($table == 'photos') {
            Photo::where('id', $id)->delete($id);
            $result = array('success' => '1', 'msg' => 'Photo has been deleted successfully!');
        }
        if ($table == 'group') {
            if(Group::where('id', $id)->delete($id)){
                Photo::where('group_id',$id)->delete();
                $result = array('success' => '1', 'msg' => 'Group has been deleted successfully!');
            }else{
                $result = array('error' => '1', 'errorMessage' => 'Group not found!');
            }
        }
        echo json_encode($result);
    }

       function claimContentMail($id) {
            $check_user = User::where('id', $id)->first();
            $labels = Label::where('user_id',$id)->count();
            if($labels > 0 ){
                if ($check_user) {
                    Mail::send('email.claim_content', [], function ($m) use ($check_user) {
                        $m->from($check_user->email, $check_user->full_name);
                        $m->to('zaman.codingpixel@gmail.com', 'Content Buddy Admin')->subject('Content Claimed Request');
                    });
                    session()->flash('success', 'Your request for claim content has been forward to Content Buddy Team.');
                    return redirect()->back();   
                } else {
                    session()->flash('error', 'user not found!');
                    return redirect()->back();
                }
            }else{
                session()->flash('error', 'You havn\'t added any info');
                return redirect()->back();
            }
    }
    
    function aboutUs() {
        $this->data['currentView'] = "about_us";
        $this->data['title'] = 'About us';
        $this->data['tab'] = 'pages';
        $this->data['result'] = Page::where('type', 'about')->first();
        return view('admin_template', $this->data);
    }

    function postAboutUs(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $page = Page::where('type', 'about')->first();
        if ($page == null) {
            $page = new Page();
        }
        $page->type = 'about';
        $page->title = $request->title;
        $page->description = $request->description;
        $page->save();
        $request->session()->flash('success', 'About us page saved successfully.');
        return redirect('about_us');
    }

    function privacyPolicy() {
        $this->data['currentView'] = "privacy_policy";
        $this->data['title'] = 'Privacy Policy';
        $this->data['tab'] = 'pages';
        $this->data['result'] = Page::where('type', 'privacy_Policy')->first();
        return view('admin_template', $this->data);
    }

    function postprivacyPolicy(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $page = Page::where('type', 'privacy_Policy')->first();
        if ($page == null) {
            $page = new Page();
        }
        $page->type = 'privacy_Policy';
        $page->title = $request->title;
        $page->description = $request->description;
        $page->save();
        $request->session()->flash('success', 'Privacy Policy page saved successfully.');
        return redirect('privacy_policy');
    }

    function termsCondition() {
        $this->data['currentView'] = "terms_condition";
        $this->data['title'] = 'Terms & Conditions';
        $this->data['tab'] = 'pages';
        $this->data['result'] = Page::where('type', 'terms_condition')->first();
        return view('admin_template', $this->data);
    }

    function posttermsCondition(Request $request) {
        $request->validate([
            'title' => 'required',
//            'description' => 'required'
        ]);
        $page = Page::where('type', 'terms_condition')->first();
        if ($page == null) {
            $page = new Page();
        }
        $page->type = 'terms_condition';
        $page->title = $request->title;
//        $page->description = $request->description;
        $page->save();
        $request->session()->flash('success', 'Terms & Conditions page saved successfully.');
        return redirect('terms_condition');
    } 

}
