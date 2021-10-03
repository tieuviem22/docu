<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    //
    public function Register(ApiRegisterRequest $request) {
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }
    public function Login(ApiLoginRequest $request) {
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = User::whereEmail($request->email)->first();
            $user->token = $user->createToken('App')->accessToken;
            return response()->json($user);
        }
       $error = [
           'status' => 401,
           'message' => 'sai tên truy cập hoặc mật khẩu'
       ];
       return response() -> json($error);
    }
    public function userInfo(Request $request ) {
        return response()->json($request->user('api'));
    }
}
