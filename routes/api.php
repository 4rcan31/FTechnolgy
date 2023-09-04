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


    Route::group(function(){
        Route::post('/sendfood', function(){
            res('sending food...');
        });


        Route::get('connect/%token', function ($token) {
            controller('CroquetteController', 'connect', $token[0]);
        })->middlewares(['AuthMiddleware@session']);

        
    })->prefix('/signal/croquette');

    
})->prefix('/api/v1');


