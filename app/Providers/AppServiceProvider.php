<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('api',function($status,$message,$data=[],$code=200){
            return response()->json([
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            ],$code);
        });
    }
}
