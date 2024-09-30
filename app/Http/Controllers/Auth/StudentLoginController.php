<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Service\Admin\UserService;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class StudentLoginController extends Controller
{
    protected $userService ;
    public function __construct(UserService $userService){
        $this->userService = $userService ;
    }
    public function login(LoginRequest $request){
        $validatedData = $request->validated();
        $token = $this->userService->studentLogin($validatedData);
        return Response::api('success','student logged in successfully',$token,200);
    }
}
