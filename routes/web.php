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

Route::get('/ws', function(){
  view('Connectionws', [], 'test/');
});




Route::group(function(){


   Route::get('/dashboard', function(){
      controller('PanelViewsController', 'home');
   });

   Route::get('/croquette', function(){
      view('dashboard/croquette');
   });

   Route::get('/logs', function(){
      res('logs');
   });

   Route::get('/settings', function(){
      res('Configuracion');
   });

   Route::get('/profile', function(){
      res('Perfil');
   });

})->prefix('/panel')->middlewares(['AuthMiddleware@session'])->setData(controller('PanelViewsController', 'userProfileData'));


Route::error(403, function(){
   Server::redirect('/');
});