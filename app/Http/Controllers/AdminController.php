<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Admin;
use App\Pages;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {

    public $data = array();

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->data['data'] = Auth()->guard('admin')->user();
            $this->data['tab'] = '';
            return $next($request);
        });
    }

    public function dashboard() {
        $this->data['currentView'] = "dashboard";
        $this->data['title'] = 'User';
        $this->data['users'] = User::orderBy('created_at','desc')->get();
        $this->data['blocked_users'] = User::where('is_blocked',1)->count();
        $this->data['active_users'] = User::where('is_blocked',0)->where('is_approved_by_admin',1)->count();
        $this->data['inactive_users'] = User::where('is_approved_by_admin',0)->count();
        return view('admin_template', $this->data);
    }

    public function loginView() {
        if (Auth()->guard('admin')->check()) {
            return redirect('/dashboard');
        }
        $data['title'] = 'Admin login';
        return view('admin_login', $data);
    }

    public function adminLogin(Request $request, $remember = 1) {
//        dd($request->all());
        $credentials = $this->validate(request(), [
            'email' => 'required',
            'password' => 'required',
                ]
        );
        
        $username = $request->email;
        $password = $request->password;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            Auth()->guard('admin')->attempt(['email' => $username, 'password' => $password]);
        } else {
            //they sent their username instead 
            Auth()->guard('admin')->attempt(['username' => $username, 'password' => $password]);
        }
        
        if (Auth()->guard('admin')->check()) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'You have no rights to log in');
        }
    }

    public function postForgotPassword(Request $request) {
        $credentials = $this->validate(request(), [
            'email' => 'required',
                ]
        );
        $email = $request->email;
        $admin_email = Admin::where('email', $email)->first();
        if ($admin_email) {
            
        } else {
            $request->session()->flash('type', 'forgot');
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function changePasswordView() {
        $this->data['currentView'] = "change_password";
        $this->data['title'] = 'Change Password';
        return view('admin_template', $this->data);
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = Auth::guard('admin')->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password_confirmation)
            ])->save();
            $request->session()->flash('success', 'Password changed successfully.');
        } else {
            $request->session()->flash('error', 'Password does not match.');
        }
        return redirect('change_password');
    }

    public function profile() {

        $this->data['currentView'] = "profile";

        $this->data['title'] = 'Admin Profile';
        return view('admin_template', $this->data);
    }

    public function updateProfile(Request $request) {

        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'location' => 'required|max:100',
            'contact_no' => 'required|max:50',
            'email' => 'unique:admins,email,' . Auth::guard('admin')->user()->id,
            'username' => 'unique:admins,username,' . Auth::guard('admin')->user()->id
        ]);

        $admin_id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($admin_id);

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->location = $request->location;
        $admin->contact_no = $request->contact_no;
        $admin->email = $request->email;
        $admin->username = $request->username;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(48, 48);
            $file_path = public_path('../public/images/profile_images/');

            $image_resize->save($file_path . $filename);
            $save_path = 'images/profile_images/' . $filename;
            $admin->photo = $save_path;
            //Remove old file
            $admin_detail = Admin::find($admin_id);
            File::delete($file_path . $admin_detail->photo);
        }

        $admin->save();
        return redirect('/profile')->with('success', 'Record Updated Successfully');
    }
    
    public function ressetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'email' => 'required',
                     ],[
                    'email.required' => 'Email field is required',
                    ]);

        if ($validator->fails()) {
            $request->session()->flash('forgetemail');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $admin = Admin::where('email',$request->email)->first();

        $current = "forgettoken";
        if($admin){
           $admin->forget_token = bcrypt($current);

           $admin->save();
           $token =$admin->forget_token ;
           Mail::send('forgetmail',['name' => $admin->name,'token' => $token], function ($m) use ($admin) {
           $m->from('codingpixel1716@gmail.com', 'Buddy');
           $m->to($admin->email,$admin->name)->subject('Your Reminder!');
        });
        return redirect()->back()->with('success', 'Email has sent');
        }
        else
        {
            $request->session()->flash('forgetemail');

            return redirect()->back()->with('notfound', 'Email not found');
        }
    }
    public function updatepassword(Request $request)
    {
//        dd($request->get('token'));
         $token = $request->get('token');
         $email_token['token'] = $token;
         return view('reset_password',$email_token);
    }
    
    public function postupdatepassword(Request $request)
    {
         $validator = Validator::make($request->all(), [
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                     ],[
                    'password.required' => ' Password must required',
                    'password.min' => ' Password lenght is too short',
                    'password.confirmed' => 'Confirm Password dosent match',
                    'password_confirmation.required' => 'Confirm Password required',
                    ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $token = $request->get('email_token');
        
        $admin = Admin::where('forget_token',$token)->first();
//        dd($token);
        if($admin){
            $passwod = $request->password;
            $admin->password = bcrypt($passwod);
            $admin->forget_token = ' ';
           
            $admin->save();

            $email = $admin->email;
            if (Auth()->guard('admin')->attempt(['email' => $email, 'password' => $passwod])) {
                return Redirect::to('dashboard');
            } else {
            
            return redirect('/')->with('error','Not login');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Token Expire');
        }
        return redirect('/dashboard')->with('success', 'Password Updated');
    }
    
    public function ressetpswdview(){
        
        return view('reset_password');
    }
}
