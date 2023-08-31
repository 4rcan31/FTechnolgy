<?php


Route::group(function(){


    Route::group(function(){
        Route::post('/register', function($request){
            controller('AuthController', 'register', $request);
        });
    
        Route::post('/login', function($request){
            controller('AuthController', 'login', $request);
        });
    
        Route::post('/logout', function(){
            controller('AuthController', 'logout');
        });
    })->prefix('/auth');
    
})->prefix('/api/v1');