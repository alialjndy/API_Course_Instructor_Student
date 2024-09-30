<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Service\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Response;

class AuthStudentController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    protected $userService ;
    public static function middleware()
    {
        return [
            new Middleware(middleware:'auth:student'),
        ];
    }
    public function __construct(UserService $userService){
        $this->middleware();
        $this->userService = $userService;
    }
    /**
     * Summary of me
     * @return mixed
     */
    public function me(){
        $info = $this->userService->me();
        return Response::api('success','student info',$info, 200);
    }
    /**
     * Summary of logout
     * @return mixed
     */
    public function logout(){
        $this->userService->logout();
        return Response::api('success','student logged out successfully',[], 200);
    }
}
