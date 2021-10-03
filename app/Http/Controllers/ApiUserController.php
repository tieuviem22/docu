<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRegisterRequest;

class ApiUserController extends Controller
{
    //
    public function Register(ApiRegisterRequest $request) {
        return 'abc';
    }
}
