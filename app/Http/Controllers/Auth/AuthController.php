<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Service\Admin\UserService;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    protected $userService ;

    public static function middleware()
    {
        return [
            new Middleware(middleware:'auth:admin',except:['login','register']),
        ];
    }
    /**
     * Summary of __construct
     * @param \App\Service\Admin\UserService $userService
     */
    public function __construct(UserService $userService){
        $this->middleware();
        $this->userService  = $userService ;
    }

    /**
     * Summary of me
     * @return mixed
     */
    public function me(){
        $info = $this->userService->me();
        return Response::api('success','user info',$info, 200);
    }
    /**
     * Summary of logout
     * @return mixed
     */
    public function logout(){
        $this->userService->logout();
        return Response::api('success','user logged out successfully',[], 200);
    }
}
