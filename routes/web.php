<?php


Route::root(function(){
   view("home");
});

Route::get('/contact', function(){
    view('contact');
});

Route::get('/aboutus', function(){
   view('aboutus');
});

Route::get('/faq', function(){
   view('faq');
});

Route::get('/store', function(){
    view('store');
});

Route::get('/see/%productID', function($request){
  view('see');
});

Route::get('/login', function(){
   view('Auth/login');
});

Route::get('/register', function(){
   view('Auth/register');
});




Route::group(function(){


   Route::get('/dashboard', function(){
      view('dashboard/home');
   });


})->prefix('/panel')->middlewares(['AuthMiddleware@session']);