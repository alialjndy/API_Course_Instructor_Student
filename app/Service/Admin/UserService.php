<?php
namespace App\Service\Admin;

use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService{
    /**
     * Summary of adminLogin
     * @param array $data
     * @throws \Exception
     * @return bool
     */
    public function adminLogin(array $data){
        try{
            $credentials = [
                'email'=>$data['email'],
                'password'=>$data['password']
            ];
            if(!$token = auth('admin')->attempt($credentials)){
                throw new Exception('Invalid credentials');
            }else{
                return $token ;
            }
        }catch(Exception $e){
            Log::error('Error when login admin '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of studentLogin
     * @param array $data
     * @throws \Exception
     * @return bool
     */
    public function studentLogin(array $data){
        try{
            $credentials = [
                'email'=>$data['email'],
                'password'=>$data['password']
            ];
            if(!$token = auth('student')->attempt($credentials)){
                throw new Exception('Invalid credentials');
            }else{
                return $token ;
            }
        }catch(Exception $e){
            Log::error('Error when login student '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of me
     * @throws \Exception
     * @return array
     */
    public function me(){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            $info = [
                'name'=>$user->name ,
                'email'=>$user->email,
                'role'=>$user->role,
            ];
            return $info ;
        }catch(Exception $e){
            Log::error('Error when show user info '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of logout
     * @throws \Exception
     * @return void
     */
    public function logout(){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
        }catch(Exception $e){
            Log::error('Error When Logged out '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
}
