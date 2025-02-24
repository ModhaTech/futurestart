<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;


class CustomLoginController extends Controller
{
    // do login Auth
public function loginUser(Request $request)
{
    $rules = [
        'email' => 'required',
        'password' => 'required'
    ];

    $customMessages = [
        'email.required' => 'Username field is required.',
        'password.required' => 'Password field is required.'
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
        return response()->json(['validation_errors' => $validator->errors()], 400);
    } 

    $email = $request->email;
    $password = $request->password;
    $remember = $request->remember;
    $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([$loginType => $email, 'password' => $password], $remember)) {
        $user = User::where([$loginType => $email])->first();

        if (!empty($user->role_id) && $user->role_id != 1) {
            $previousRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

            $previousUrl = $previousRoute == 'register' ? route('home') : url()->previous();

            $response = [
                'status' => 'success',
                'message' => 'Login Successful!',
                'role_id' => $user->role_id,
                'url' => $previousUrl
            ];
        } else {
            Auth::logout();
            $response = [
                'status' => 'error',
                'message' => 'Login Fail! This is an unauthorised action.'
            ];
        }

        
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Login Fail! Username or password is incorrect.'
        ]);
    }
    return response()->json($response);
}

}