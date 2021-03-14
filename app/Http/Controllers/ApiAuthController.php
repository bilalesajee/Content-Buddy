<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\UserSession;
use Validator;
use App\User;

class ApiAuthController extends Controller {

    function postRegister(Request $request) {

        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|max:191',
                    'last_name' => 'required|max:191',
                    'email' => 'required|email|unique:users|max:191',
                    'password' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip_code' => 'required',
                    'phone' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $user = new User();
        $email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->full_name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->image = 'images/profile_images/user-placeholder.jpg';
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip_code = $request->zip_code;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password); 
        $user->type = 'user';
        $activate_code = Str::random(15);
        $user->email_confirmaiton_token = $activate_code;
        $user->is_active = 0; 
        
        $user->save();
        if($user->id){
            $token = bcrypt(time());
            $user_sess = new UserSession();
            $user_sess->user_id = $user->id;
            $user_sess->session_token = $token;
            $user_sess->save();
            $user->session_token = $token;
        }
        //Send Confirmation Email
        $viewData['title'] = 'Content Buddy Account Confirmation';
        $viewData['link'] = url('verify_email') . '/' . $activate_code;
        $viewData['full_name'] = $user->full_name;
        $viewData['user_email'] = $email;
        $viewData['activate_code'] = $activate_code;
        $viewData['message_text'] = "Thank you for signing up for your new account at content Buddy. Follow the link below to confirm your account";
        Mail::send('email.email_verification_mail',$viewData, function ($m) use ($email) {
//            $m->from(env('MAIL_FROM'), 'Content Buddy');
            $m->from(env('MAIL_USERNAME', 'Account Registration'), 'Content Buddy');
            $m->to($email)->subject('Welcome to Content Buddy!');
        });
        return sendSuccess('User register successfully', $user);
    }

    function postLogin(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|exists:users',
                    'password' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors, 405);
        }

        $email = $request->email;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            Auth::attempt(['email' => $email, 'password' => $request['password']]);
        }
//        } else {
//            //they sent their username instead
//            Auth::attempt(['username' => $username, 'password' => $request['password']]);
//        }

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_active == 1) {
            if ($user->is_approved_by_admin == 1) {
                if ($user->is_blocked == 0) {
                        $token = bcrypt(time());
                        $user = User::find(Auth::user()->id);
                        $sess_user = new UserSession();
                        $sess_user->user_id = Auth::user()->id;
                        $sess_user->session_token = $token;
                        $sess_user->save();

                        $user->session_token = $token;
                        return sendSuccess('Login Successfully', $user);
                    } else {
                        return sendError('Your account is blocked by Content Buddy Team.');
                    }
                } else {
                    return sendError('Your account is not approved by Content Buddy Team.');
                }
            } else {
                
                return sendError('Your account is not verified,Please Verify your account first.');
            }
        } else {
            return sendError('Invalid password');
        }
    }

    function forgetPasswordMail(Request $request) {
//        Log::info($request->all());
        if (isset($request->email) && $request->email != '') {

            $check_email = User::where('email', $request->email)->first();
            if ($check_email) {
                $code = $this->generateRandomString(20);
                $token = sha1($code);
                $check_email->forgot_token = $token;
                $check_email->save();
                $viewData['full_name'] = $check_email->full_name;
                $viewData['link'] = asset('reset_password/' . $token);

                Mail::send('email.forgetmail', $viewData, function ($m) use ($check_email) {
                    $m->from(env('MAIL_USERNAME'), 'Content Buddy');
                    $m->to($check_email->email, $check_email->full_name)->subject('Your New Password');
                });
                return sendSuccess('Please check email for new password');
            } else {
                return sendError('Email Not Found');
            }
        } else {
            return sendError('Email is Required');
        }
    }

    function resetPasswordView($token = '') {
        $data = array();
        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        return view('reset_password', $data);
    }

    function postResetPassword(Request $request) {
        $token = $request->token;
        $user_record = User::where('email_token', $token)->first();
        if ($user_record) {
            $request->validate([
                'password' => 'required|confirmed|min:6'
            ]);
            $data = array('password' => bcrypt($request->password), 'email_token' => '');
            User::where('email_token', $token)->update($data);
            Session()->flash('success', 'Password has been changed successfully!');
            return redirect('/reset-password/' . $token);
        }
        Session()->flash('error', 'Sorry ! Link have been expired , please regenerate the link');
        return redirect('/reset-password/' . $token);
    }

    public function logout(Request $request) {
        $headers = getallheaders();
//        User::where(['session_token' => $headers['session_token']])->update(['session_token' => null]);
        UserSession::where(['session_token' => $headers['session_token']])->delete();
        return sendSuccess('You are logged out successfully!', null);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOP!@#$';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function checkEmail(Request $request) {
//        $validation = $this->validate($request, [
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191'
        ]);
        if ($validator->fails()) {
            return sendError($validator, 400);
        }
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            return sendError("This email has been taken already.", 400);
        }
        return sendSuccess('Ready To Go!', '');
    }

}
