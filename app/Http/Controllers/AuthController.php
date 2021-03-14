<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller {

    function login() {
        if (Auth::guard()->check()) {
            return redirect(url('/user_dashboard'));
        }
        $data['title'] = 'Sign In';
        return view('frontend.login', $data);
    }

    function register() {
        if (Auth::check()) {
            return redirect(url('/user_dashboard'));
        }
        $data['title'] = 'Sign Up';
        return view('frontend.register', $data);
    }

    function postRegister(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = New User();
        if ($request['pic']) {
            $photo_name = time() . '.' . $request->pic->getClientOriginalExtension();
            $request->pic->move('resources/frontend/images', $photo_name);
            $photo_name = $photo_name;
            $user->photo = $photo_name;
        }

        $email = $request->email;
        $pwd = $request->password;
        $activate_code = Str::random(15);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->full_name = $user->first_name . ' ' . $request->last_name;
        $user->email = $email;
        $user->email_confirmaiton_token = $activate_code;
        $user->password = bcrypt($pwd);
        $user->image = 'images/profile_images/user-placeholder.jpg';
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip_code = $request->zipcode;
        $user->phone = $request->phone_no;
        $user->type = 'user';
        $user->is_active = 0;
        $user->save();

        $viewData['link'] = url('verify_email') . '/' . $activate_code;
        $viewData['full_name'] = $request->first_name . ' ' . $request->last_name;
        $viewData['activate_code'] = $activate_code;

        //Send Confirmation Email
        $viewData['title'] = 'Content Buddy Account Confirmation';
        $viewData['link'] = url('verify_email') . '/' . $activate_code;
        $viewData['full_name'] = $user->full_name;
        $viewData['user_email'] = $email;
        $viewData['activate_code'] = $activate_code;
        $viewData['message_text'] = "Thank you for signing up for your new account at content Buddy. Follow the link below to confirm your account";


        Mail::send('email.email_verification_mail', $viewData, function ($m) use ($email) {
//            $m->from(env('MAIL_FROM'), 'Content Buddy');
            $m->from(env('MAIL_USERNAME', 'Account Registration'), 'Content Buddy');
            $m->to($email)->subject('Welcome to Content Buddy!');
        });
        $request->session()->flash('success', 'Thank you for signing up for your new account at content Buddy.');
        return redirect('/thank_you');
    }

    function postLogin(Request $request) {
//        dd($request->all());
        $this->validate($request, [
            'email' => 'required|max:191',
            'password' => 'required'
        ]);
        $username = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            $user = User::find(Auth::id());
            if ($user->is_active != 1) {
                Auth::logout();
                return redirect('login')->with('error', 'Please verify your account from your email !');
            }
            if ($user->is_approved_by_admin != 1) {
                Auth::logout();
                return redirect('login')->with('error', 'Your account is not activated !');
            }
            if ($user->is_blocked == 1) {
                Auth::logout();
                return redirect('login')->with('error', 'Your account is blocked by admin !');
            }
            return redirect('user_dashboard');
        } else {
            return redirect()->back()->withErrors(['Invalid email or password']);
        }
    }

    function forgotPasswordView() {
        $data['title'] = 'Reset password';
        $data['currentView'] = 'resend_password';
        return view('frontend', $data);
    }

    public function verifyEmail($key) {
        $user_record = User::where('email_confirmaiton_token', $key)->first();
        if ($user_record) {
            $data = array('is_active' => 1, 'email_confirmaiton_token' => '');
            if (User::where('email_confirmaiton_token', $key)->update($data)) {
                $data['message'] = 'Your Account verified successfully';
                return view('success_template', $data);
            }
            $data['message'] = 'Sorry ! there are some errors please try again later';
            return view('errror_template', $data);
        }
        $data['message'] = 'Sorry ! Activation link is expired';
        return view('errror_template', $data);
    }

    public function sendForgotPassword(Request $request) {

        $this->validate($request, [
            'email' => 'required'
        ]);

        $forgot_email = $request->email;
        $email = User::where('email', $forgot_email)->first();
        if ($email) {
            $forgot_token = md5(time());
            $data_token = array('forgot_token' => $forgot_token);
            User::where('email', $forgot_email)->update($data_token);

            $link = url('reset_password') . '/' . $forgot_token;
            $full_name = $email->first_name . ' ' . $email->last_name;
            Mail::send('email.forgetmail', ['full_name' => $full_name, 'link' => $link], function ($m) use ($email) {
                $full_name = $email->first_name . ' ' . $email->last_name;
                $m->from(env('MAIL_USERNAME'), 'ContentBuddy Forgot password');
                $to = $email;

                $m->to($email->email, $full_name)->subject('Password Reset link');
            });
        } else {
            return redirect(url('/forgotPassword'))->withErrors('Invalid Email address');
        }
        return redirect(url('/forgotPassword'))->withSuccess('We just emailed you a link, Please check your email and Reset the Password.');
    }

    public function submitResetPassword(Request $request, $key) {
        $key = $request->token;
        $user_record = User::where('forgot_token', $key)->first();
       
        if ($user_record) {
            $request->validate([
                'password' => 'required|confirmed|min:6'
            ]);
            $data = array('password' => bcrypt($request->password), 'forgot_token' => '');

            if (User::where('forgot_token', $key)->update($data)) {

                Session()->flash('success', 'Password changed successfully');
                $data['title'] = 'Bizinfo invalid link';
                $data['message'] = 'Password changed successfully';
                return view('success_template', $data);
            } else {
                Session()->flash('error', 'Sorry! there is some errors please try later');
            }
            return redirect()->back();
        }

        Session()->flash('error', 'Sorry ! Link has been expired. regenerate the link to reset password');
        return redirect()->back();
    }

    function resetPasswordView(Request $request, $token) {
        if (!isset($token) || $token == '') {
            $request->Session()->flash('error', 'Invalid link');
            return redirect(url('/'));
        }
        $data = array();
        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        return view('frontend.forgot_password', $data);
    }

    function postResetPassword(Request $request) {
        $token = $request->token;
        $user_record = User::where('forgot_token', $token)->first();
     
//        $user_record = User::where('password_reset_token', $token)->first();
      
        if ($user_record) {
            $request->validate([
                'password' => 'required|confirmed|min:3'
            ]);
            $data = array('password' => bcrypt($request->password), 'forgot_token' => '');
            $user_data = User::where('forgot_token', $token)->first();
            if (User::where('forgot_token', $token)->update($data)) {
                Session()->flash('success', 'Password changed successfully');
            } else {
                Session()->flash('error', 'Sorry!there is some errors please try later.');
            }
            $data['message'] = 'You have changed your password successfully.';
            return view('success_template', $data);
        }
        Session()->flash('error', 'Sorry!This link has been expired,please regenerate the link.');
        return redirect()->back();
    }

    //    public function forgotPassword($id) {
//
//        $user_record = User::where('forgot_token', $id)->first();
//
//        if ($user_record) {
//            $data = array();
//            $data['key'] = $id;
//            return view('frontend/reset_password',$data);
//        } else {
//            $data['title'] = 'Bizinfo invalid link';
//            $data['message'] = 'Sorry ! Invalid reset password link';
//            return view('errror_template', $data);
//        }
//    }

    public function errorTemplate() {
        $data = array();
        $data['title'] = 'asdf';
        $data['message'] = 'Sorry ! Your link is expired';
        return view('errror_template', $data);
    }

    public function errorSuccess() {
        $data = array();
        $data['title'] = 'asdf';
        $data['message'] = 'Password reset successfully';
        return view('success_template', $data);
    }

    function logout() {
        Auth::logout();
        return redirect('/');
    }

}
