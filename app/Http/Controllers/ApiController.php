<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\User;
use App\UserSession;
use App\Item;
use App\Photo;
use App\Label;
use App\Room;
use App\Group;

class ApiController extends Controller {

    protected $user_id = '';

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::id();
            return $next($request);
        });
    }

    function allRooms() {
        $Rooms = Room::all();
        return sendSuccess('All Rooms', $Rooms);
    }

    function allGroups() {
        $user = Auth::user();
        $groups = Group::where('user_id', $user->id)->get();
//        $groups = Group::where('user_id', $user->id)->with('getLabel','getGroupPhotos')->get();
        return sendSuccess('All Groups', $groups);
    }
    
    function allPhotos() {
        $user = Auth::user();
        $photos = Photo::where('user_id', $user->id)->with('getLabel')->get();
//        $photos = Photo::where('user_id', $user->id)->with('getLabel','getGroup','getGroup.getGroupPhotos')->get();
        return sendSuccess('All Photos', $photos);
    }
    function allNonGroupPhotos() {
        $user = Auth::user();
        $groups = Photo::where('user_id', $user->id)->where('type', '0')->with('getSingleLabel')->get();
        return sendSuccess('All Non Group Photos', $groups);
    }
    
    function allMultiLabelPhotos() {
        $user = Auth::user();
        $groups = Photo::where('user_id', $user->id)->where('type', '1')->with('getLabel')->get();
        return sendSuccess('All multi label photos', $groups);
    }
    
    function allItems() {
        $user = Auth::user();
        $Items = Item::where('user_id', $user->id)->with('ItemGroups.getGroupPhotos')->with('ItemPhotos')->with('multiLabelPhotos')->get();
        if($Items->isEmpty()){
            return sendSuccess('This user havn\'t added any room ', $Items);
        }else{
            return sendSuccess('All Room', $Items);
        }
    }

    function itemDetail($id) {
        $single_photos = Photo::select('id')->where('item_id', $id)->where('type', '0')->orderBy('updated_at')->get()->toArray();
        $label_photos = Photo::select('id')->where('item_id', $id)->where('type', '1')->orderBy('updated_at')->get()->toArray();
        $group_photos = Photo::select('id')->groupBy('group_id')->where('item_id', $id)->where('type', '2')->orderBy('updated_at')->get()->toArray();
//        $group_photos = Photo::select('id')->groupBy('group_id')->where('item_id', $id)->where('image_path','!=','empty')->where('type', '2')->orderBy('updated_at')->get()->toArray();
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
                ->with('multiLabelPhotos')
                ->with('ItemGroups')
                ->orderBy('updated_at')
                ->first();
        if ($Items) {
            return sendSuccess('Room Detail!', $Items);
        } else {
            return sendError('Room Not Found!');
        }
    }

    function addItem(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required'
//                    'description' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        $item = New Item();
        $item->user_id = $user->id;
        $item->title = $request->title;
//        $item->description = $request->description;
        $item->save();
        return sendSuccess('Room created successfully', $item);
    }

    function editItem(Request $request) {
        $validator = Validator::make($request->all(), [
                    'item_id' => 'required',
                    'title' => 'required'
//                    'description' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $item = Item::where('id', $request->item_id)->first();
        if ($item) {
            $item->title = $request->title;
//            $item->description = $request->description;
            $item->save();
            return sendSuccess('Room updated successfully', $item);
        } else {
            return sendError('Room Not Found');
        }
    }

    function deleteItem(Request $request) {
        $validator = Validator::make($request->all(), [
                    'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        if (Item::where('id', $request->item_id)->delete()) {
            return sendSuccess('Room deleted successfully');
        } else {
            return sendError('Room Not Found');
        }
    }

    function updateProfile(Request $request) { 
        Log::info($request->all());
        Log::info($request->first_name);
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::User();
        if ($request['first_name']) {
            $user->first_name = $request['first_name'];
            $user->full_name = $request['first_name'] . ' ' . $request['last_name'];
        }
        if ($request['last_name']) {
            $user->last_name = $request['last_name'];
            $user->full_name = $request['first_name'] . ' ' . $request['last_name'];
        }
        if ($request->file('image')) {
            $image = $request->file('image');
            if ($image) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'public/images/profile_images';
                $image->move($destinationPath, $input['imagename']);
                $user->image = 'images/profile_images/' . $input['imagename'];
            }
        }
        if ($request['address']) {
            $user->address = $request['address'];
        }
        if ($request['city']) {
            $user->city = $request['city'];
        }
        if ($request['state']) {
            $user->state = $request['state'];
        }
        if ($request['zip_code']) {
            $user->zip_code = $request['zip_code'];
        }
        if ($request['phone']) {
            $user->phone = $request['phone'];
        }
        $user->save();
        $sess_user = UserSession::where('user_id',$user->id)->first();
        $user->session_token = $sess_user->session_token;
        return sendSuccess('User data updated successfully', $user);
    }

    function addPhoto(Request $request) {
//        dd($request->all());
//        Log::info('Showing al result: '.$request->all());
        $validator = Validator::make($request->all(), [
//                    'item_id' => 'required',
                    'images' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
//        $add_photo = new Photo();
//        $add_photo->user_id = $user->id;
//        $add_photo->item_id = $request->item_id;
//        if ($request->group_id) {
//            $add_photo->group_id = $request->group_id;
//        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = str_random(5) . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'public/images/users_image/';
                $file->move($destinationPath, $name);
                $Photo = new Photo();
                $Photo->user_id = $user->id;
                $Photo->image_path = 'images/users_image/' . $name;
                $Photo->item_id = $request->item_id;
                $Photo->type = '0';
                $Photo->save();
            }
            
            
//            $image = $request->file('image');
//            if ($image) {
//                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
//                $destinationPath = 'public/images/users_image';
//                $image->move($destinationPath, $input['imagename']);
//                $add_photo->image_path = 'images/users_image/' . $input['imagename'];
//            }
        } else {
            return sendError('Image not uploaded');
        }
        if ($request->label) {
            $data = json_decode($request->label);
            if ($data) {
                foreach ($data as $label_value) {
//                    $room = Room::where('id',$label_value->room_id)->first();
//                    $room_name = $room->title;
                    $label = new Label();
                    $label->user_id = $user->id;
                    $label->photo_id = $Photo->id;
                    $label->group_id = $Photo->group_id;
//                    $label->room_id = $label_value->room_id;
//                    $label->room_name = $room_name;
                    $label->room_name = $label_value->room_name;
                    $label->item_name = $label_value->item_name;
                    $label->brand = $label_value->brand;
                    $label->model = $label_value->model;
                    $label->serial_no = $label_value->serial_no;
                    $label->quantity = $label_value->quantity;
                    $label->age_in_years = $label_value->age_in_years;
                    $label->age_in_months = $label_value->age_in_months;
                    $label->cost_to_replace = $label_value->cost_to_replace;
                    $label->save();
                    $Photo->is_labeled = 1;
                    $Photo->save();
                    $photo_detail = Photo::where('id',$Photo->id)->with('getLabel')->get();
                    return sendSuccess('Photo Added with label,here is photo deatil', $photo_detail);
                }
            }
        } else {
                $Item_detail = Item::where('id', $request->item_id)->with('ItemSinglePhotos')->first();
                return sendSuccess('You have added photos without label,here are all single photos in this item', $Item_detail);
        }
//        if ($request->labels) {
//            $data = json_decode($request->labels);
//            if ($data) {
//                foreach ($data as $label_value) {
//                    $label = new Label();
//                    $label->user_id = $user->id;
//                    $label->photo_id = $add_photo->id;
//                    $label->group_id = $add_photo->group_id;
//                    $label->room_id = $label_value->room_id;
//                    $label->item_name = $label_value->item_name;
//                    $label->brand = $label_value->brand;
//                    $label->model = $label_value->model;
//                    $label->quantity = $label_value->quantity;
//                    $label->age_in_years = $label_value->age_in_years;
//                    $label->age_in_months = $label_value->age_in_months;
//                    $label->save();
//                }
//                $add_photo->is_labeled = 1;
//                $add_photo->save();
//                return sendSuccess('Photo Added with label!', $add_photo);
//            }
//        }else{
//            return sendSuccess('Photo Added!', $add_photo);
//        }
    }

    function moveGroupPhotos(Request $request) {
        $validator = Validator::make($request->all(), [
                    'group_id' => 'required',
                    'photo_ids' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        $photo_ids = explode(',', $request->photo_ids);
        $user = Auth::user();
        if ($photo_ids[0] != '') {
            foreach ($photo_ids as $photo_id) {
                $photo = Photo::where('id', $photo_id)->where('user_id', $user->id)->first();
                if ($photo) {
                    $is_labeled = $photo->is_labeled;
                    if($is_labeled == '1'){
                        Label::where('photo_id',$photo->id)->delete();
                    }
                    $photo->group_id = $request->group_id;
                    $photo->is_labeled = '1';
                    $photo->type = '2';
                    $photo->save();
                    $user_detail = User::where('id', $user->id)->with('userItems')->get();
                } else {
                    return sendError('This user don\'t have any photo with this id');
                }
            }
        }else{
            return sendError('There is no photo to add into a group');
        }
        return sendSuccess('Photos moved to a group successfully', $user_detail);
    }
    
    function deleteItemContent(Request $request) {
        $photo_ids = explode(',', $request->photo_ids);
        $group_ids = explode(',', $request->group_ids);
        $user = Auth::user();
        $photo_delete = false;
        if($photo_ids[0] != ''){
            foreach ($photo_ids as $photo_id) {
                if (Photo::where('id', $photo_id)->exists()) {
                    $photo = Photo::where('id', $photo_id)->where('user_id', $user->id)->first();
                    if($photo){
                        unlink('public/' . $photo->image_path);
                        $photo->delete();
                    }else{
                        return sendError('This user don\'t have any photo with this id');
                    }
                    $photo_delete = true;
//                    return sendSuccess('Photos deleted successfully');
                } else {
                    return sendError('Your Photo with id ' . $photo_id . ' Not Found!');
                }
            }
        }
        $group_delete = false;
        if ($group_ids[0] != '') {
            foreach ($group_ids as $group_id) {
                if (Group::where('id', $group_id)->exists()) {
                    $group = Group::where('id', $group_id)->where('user_id', $user->id)->first();
                    if ($group) {
                        $group->delete();
                    } else {
                        return sendError('This user don\'t have any group with this id');
                    }
                    $group_delete = true;
//                    return sendSuccess('Groups deleted successfully');
                } else {
                    $group_delete = false ;
                    return sendError('Your group with id ' . $group_id . ' not found for this user!');
                }
            }
        }
        if ($photo_delete && $group_delete) {
            return sendSuccess('Photos and groups deleted successfully');
        } else if ($group_delete) {
            return sendSuccess('Groups deleted successfully');
        } else if ($photo_delete) {
            return sendSuccess('Photos deleted successfully');
        } else {
            return sendError('There is no photo id or group id to delete data.');
        }
    }

    function addLabel(Request $request) {
        $validator = Validator::make($request->all(), [
                    'photo_id' => 'required',
//                    'room_id' => 'required',
                    'item_name' => 'required',
                    'age_in_months' => 'max:12'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
//        if($request->room_id){
//            $room = Room::where('id',$request->room_id)->first();
//            if($room){
//                $room_name = $room->title;
//            }else{
//                return sendError('There is no room with this id .');
//            }
//        }
        $photo = Photo::where('id',$request->photo_id)->where('user_id',$user->id)->first();
        if(!$photo){
            return sendError('There is no photo with this id for this user.');
        }
        if($photo->is_labeled == 1 && $photo->type == '0' ){
            return sendError('Label of this photo has been added already.');
        }
//        $group = Group::where('id',$request->group_id)->where('user_id',$user->id)->first();
//        if(!$group){
//            return sendError('There is no group with this id for this user.');
//        }
        $label = new Label();
        $label->user_id = $user->id;
        $label->photo_id = $request->photo_id;
        $label->group_id = $request->group_id;
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
        $photo->is_labeled =1;
        $photo->save();
        return sendSuccess('Label added successfully!');
    }
    
    function addLabelOnly(Request $request) {
        $validator = Validator::make($request->all(), [
//                    'room_id' => 'required',
                    'item_name' => 'required',
                    'age_in_months' => 'max:12'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
//        if($request->room_id){
//            $room = Room::where('id',$request->room_id)->first();
//            if($room){
//                $room_name = $room->title;
//            }else{
//                return sendError('There is no room with this id .');
//            }
//        }
        $label = new Label();
        $label->user_id = $user->id;
//        $label->photo_id = $request->photo_id;
//        $label->group_id = $request->group_id;
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
        return sendSuccess('Only Label added successfully!');
    }

    function editLabel(Request $request) {
        $validator = Validator::make($request->all(), [
                    'label_id' => 'required',
//                    'room_id' => 'required',
                    'item_name' => 'required',
                    'age_in_months' => 'max:12'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
//        if($request->room_id){
//            $room = Room::where('id',$request->room_id)->first();
//            if($room){
//                $room_name = $room->title;
//            }else{
//                return sendError('There is no room with this id .');
//            }
//        }
        $label = Label::where('id', $request->label_id)->where('user_id', $this->user_id)->first();
        if(!$label){
             return sendError('This user don\'t have any label with this id .');
        }
//        $label->photo_id = $request->photo_id ;
//        $label->group_id = $request->group_id ;
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
        return sendSuccess('Label updated successfully!');
    }

    function deleteLabel(Request $request) {
        $validator = Validator::make($request->all(), [
                    'label_id' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $label = Label::where('id', $request->label_id)->first();
        if ($label) {
            Label::where('id', $request->label_id)->delete();
            return sendSuccess('Label deleted successfully!');
        } else {
            return sendError('Label Not Found!');
        }
    }

    function addMultiLabelPhoto(Request $request) {
//        dd($request->all());
//        Log::info($request->all());
//        Log::info($request->item_id);
        $validator = Validator::make($request->all(), [
                    'item_id' => 'required',
                    'image' => 'required',
                    'labels' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();

        if ($request->file('image')) {
            $add_photo = new Photo();
            $add_photo->user_id = $user->id;
            $add_photo->item_id = $request->item_id;
            $image = $request->file('image');
            if ($image) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'public/images/users_image';
                $image->move($destinationPath, $input['imagename']);
                $add_photo->image_path = 'images/users_image/' . $input['imagename'];
            }
        } else {
            return sendError('Image not uploaded');
        }
        $add_photo->save();

        if ($request->labels) {
            $data = json_decode($request->labels);
            if ($data) {
                foreach ($data as $label_value) {
//                    $room = Room::where('id',$label_value->room_id)->first();
//                    $room_name = $room->title;
                    $label = new Label();
                    $label->user_id = $user->id;
                    $label->photo_id = $add_photo->id;
                    $label->group_id = $add_photo->group_id;
//                    $label->room_id = $label_value->room_id;
//                    $label->room_name = $room_name;
                    $label->room_name = $label_value->room_name;
                    $label->item_name = $label_value->item_name;
                    $label->brand = $label_value->brand;
                    $label->model = $label_value->model;
                    $label->serial_no = $label_value->serial_no;
                    $label->quantity = $label_value->quantity;
                    $label->age_in_years = $label_value->age_in_years;
                    $label->age_in_months = $label_value->age_in_months;
                    $label->cost_to_replace = $label_value->cost_to_replace;
                    $label->save();
                }
                $add_photo->is_labeled = 1;
                $add_photo->type = '1';
                $add_photo->save();
                return sendSuccess('Photo Added with labels!', $add_photo);
            }
        } else {
            return sendSuccess('Photo Added without any label!', $add_photo);
        }
    }

    function addGroupPhotos(Request $request) {
        $validator = Validator::make($request->all(), [
                    'group_id' => 'required',
                    'images' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        if ($request->hasFile('images')) {
            
            foreach ($request->file('images') as $file) {
                $name = str_random(5) . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'public/images/users_image/';

                //Create thumbnail 
//                $real_path = $file->getRealPath();
//                $image_resize = Image::make($real_path);
//                $image_resize->resize(150, 150);
//                $image_resize->save($destinationPath . 'thumb_' . $name);

                $file->move($destinationPath, $name);
                $Photo = new Photo();
                $Photo->user_id = $user->id;
                $Photo->image_path = 'images/users_image/' . $name;
                $Photo->item_id = $request->item_id;
                $Photo->group_id = $request->group_id;
                $Photo->type = '2';
//                $media->thumbnail_path = 'class_gallery/thumb_' . $name;
                $Photo->save();
            }
            $group_data = Group::where('id',$request->group_id)->with('getGroupPhotos')->with('getLabel')->get();
            return sendSuccess('Photos Added within a group!', $group_data);
        } else {
            return sendError('Images not uploaded');
        }
    }

    function createGroup(Request $request) {
        $validator = Validator::make($request->all(), [
                    'item_id' => 'required',
                    'label' => 'required',
                    'title' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        $group = new Group();
        $group->user_id = $user->id;
        $group->item_id = $request->item_id;
        $group->title = $request->title;
        $group->save();
        $photo = new Photo();
        $photo->user_id = $user->id;
        $photo->item_id = $request->item_id;
        $photo->group_id = $group->id;
        $photo->is_labeled = 1;
        $photo->type = '2';
        $photo->save();
        if ($request->label) {
            $data = json_decode($request->label);
            if ($data) {
                foreach ($data as $label_value) {
//                    $room = Room::where('id',$label_value->room_id)->first();
//                    $room_name = $room->title;
                    $label = new Label();
    //                    $label->photo_id = $add_photo->id;
                    $label->user_id = $user->id;
                    $label->group_id = $group->id;
//                    $label->room_id = $label_value->room_id;
                    $label->room_name = $label_value->room_name;
                    $label->item_name = $label_value->item_name;
                    $label->brand = $label_value->brand;
                    $label->model = $label_value->model;
                    $label->serial_no = $label_value->serial_no;
                    $label->quantity = $label_value->quantity;
                    $label->age_in_years = $label_value->age_in_years;
                    $label->age_in_months = $label_value->age_in_months;
                    $label->cost_to_replace = $label_value->cost_to_replace;
                    $label->save();
                }
                $group_data = Group::where('id',$group->id)->with('getLabel')->get();
                return sendSuccess('Group Created  with label!', $group_data);
            }
        } else {
            return sendSuccess('Group Created Successfully', $group_data);
        }
    }

    function photoDetail($id) {
        $user = Auth::user();
        $photo = Photo::where(['id' => $id, 'user_id' => $user->id])->with('getLabel')->first();
//        dd($group);
        if ($photo) {
            return sendSuccess('Photo Detail!', $photo);
        } else {
            return sendError('Photo not found for this user!');
        }
    }
    
    function groupDetail($id) {
        $user = Auth::user();
        $group = Group::where(['id' => $id, 'user_id' => $user->id])->with('getItem', 'getLabel', 'getGroupPhotos')->first();
//        dd($group);
        if ($group) {
            return sendSuccess('Group Detail!', $group);
        } else {
            return sendError('Group not found for this user!');
        }
    }

    function updateGroup(Request $request) {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
                    'group_id' => 'required',
                    'title' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        $group = Group::where('id', $request->group_id)->with('getLabel')->first();
        if(!$group){
            return sendError('Group with this id for this user doesn\'t exist' );
        }
        $group->title = $request->title;
        $group->save();
        if ($request->label) {
            $data = json_decode($request->label,true);
            if ($data) {
                foreach ($data as $label_value) {
//                    $room = Room::where('id',$label_value['room_id'])->first();
//                    if(!$room){
//                        return sendError('Room with this id doesn\'t exist' );
//                    }
//                    dd($request->group_id);
//                    $room_name = $room->title;
                    $label = Label::where('group_id', $request->group_id)->where('user_id', $user->id)->first();
                    if(!$label) {
                        $label = new Label();
                        $label->user_id = $user->id;
                        $label->group_id = $group->id;
                    }
//                    $label->room_id = $label_value['room_id'];
//                    $label->room_name = $room_name;
                    $label->room_name = $label_value['room_name'];
                    $label->item_name = $label_value['item_name'];
                    $label->brand = $label_value['brand'];
                    $label->model = $label_value['model'];
                    $label->serial_no = $label_value['serial_no'];
                    $label->quantity = $label_value['quantity'];
                    $label->age_in_years = $label_value['age_in_years'];
                    $label->age_in_months = $label_value['age_in_months'];
                    $label->cost_to_replace = $label_value['cost_to_replace'];
                    $label->save();
                }
                $group_data = Group::where('id',$group->id)->with('getLabel')->with('getGroupPhotos')->get();
                return sendSuccess('Group updated with label!', $group_data);
            }else{
                return sendError('error in label\'s data' );
            }
        } else {
            return sendSuccess('Group updated successfully', $group);
        }
    }

    function deleteGroup(Request $request) {
        $validator = Validator::make($request->all(), [
                    'group_id' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $group_ids = explode(',', $request->group_id);
        $user = Auth::user();
        foreach ($group_ids as $group_id) {
            if (Group::where('id', $group_id)->exists()) {
                $group = Group::where('id', $group_id)->where('user_id', $user->id)->first();
                $group->delete();
                return sendSuccess('Group deleted successfully');
            } else {
                return sendError('Your Group with id ' . $photo_id . ' Not Found!');
            }
        }
    }

    function seacrh(Request $request) {
//        dd($request->all());
//        $validator = Validator::make($request->all(), [
//                    'search_by' => 'required'
//        ]);
//        if ($validator->fails()) {
//            $errors = implode(', ', $validator->errors()->all());
//            return sendError($errors);
//        }
        $user = Auth::user();
        $query = Photo::query();
        if ($request->item_id) {
            $query->where(['item_id' => $request->item_id, 'user_id' => $user->id]);
        }
        if ($request->group_id) {
            $query->where(['group_id' => $request->group_id, 'user_id' => $user->id]);
        }
        if ($request->sort_by_photo == 1) {
            $query->where(['type' => '0', 'user_id' => $user->id]);
        }
        if ($request->search_by_not_labeled == 1) {
            $query->where(['is_labeled' => 0, 'user_id' => $user->id])->where('type','0');
        }
        if ($request->search_by_label == 1) {
            $query->where(['is_labeled' => 1, 'user_id' => $user->id])->where('type','!=','2')->with('getLabel');
        }
        if ($request->search_by_group == 1) {
            $query->where('group_id', '!=', null)->where('image_path', '!=', 'empty')->where('type','2')->where('user_id', $user->id)->groupBy('group_id')->with('getGroup.getLabel');
        }
        if ($request->sort_by_asc == 1) {
            $query->orderBy('created_at', 'asc');
        }
        if ($request->sort_by_desc == 1) {
            $query->orderBy('created_at', 'desc');
        }
        if ($request->item_name) {
            $item_name = $request->item_name;
            $query->when($item_name, function($q) use ($item_name) {
                $q->whereHas('getLabel', function ($q) use($item_name) {
                    $q->where('item_name', 'like', "%$item_name%");
                });
            });
        }
        if ($request->room_name) {
            $room_name = $request->room_name;
            $query->when($room_name, function($q) use ($room_name) {
                $q->whereHas('getLabel.getRoom', function ($q) use($room_name) {
                    $q->where('title', 'like', "%$room_name%");
                });
            });
        }
        $data['result'] = $query->with('getGroup.getLabel')->with('getLabel')->get();
        return sendSuccess('search completed successfully.', $data);
    }
    
    function claimContentMail(Request $request) {
        $validator = Validator::make($request->all(), [
                    'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
            $check_user = User::where('id', $request->user_id)->first();
            if ($check_user) {
                Mail::send('email.claim_content', [], function ($m) use ($check_user) {
                    $m->from($check_user->email, $check_user->full_name);
                    $m->to('zaman.codingpixel@gmail.com', 'Content Buddy Admin')->subject('Content Claimed Request');
                });
                return sendSuccess('Your request for claim content has been forward to Content Buddy Team');
            } else {
                return sendError('Wrong user id');
            }
    }
    
    function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
                    'current_password' => 'required|min:3',
                    'password' => 'required|confirmed|min:3'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return sendSuccess('Password Changed Successfully', $user);
        }
        return sendError('Invalid Old Password');
    }

}
