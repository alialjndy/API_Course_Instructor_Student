<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Service\Admin\UserService;
use Illuminate\Support\Facades\Response;

class AdminLoginController extends Controller
{
    protected $userService ;
    public function __construct(UserService $userService){
        $this->userService = $userService ;
    }
    public function login(LoginRequest $request){
        $validatedData = $request->validated();
        $token = $this->userService->adminLogin($validatedData);
        return Response::api('success','admin logged in successfully',$token,200);
    }
}
