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
   controller('ViewsUserAoutSessionController', 'seeFaq');
});

Route::get('/store', function(){
   controller('ViewsUserAoutSessionController', 'seeStore');
});

Route::get('/see/%productID', function($request){
   controller('ViewsUserAoutSessionController', 'seeProduct', $request[0]);
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
      view('dashboard/Croquette/dashboard');
   });

   Route::get('/statusservices', function(){
      controller('PanelViewsController', 'statusServer');
   });

   Route::get('/logs', function(){
      view('dashboard/logs');
   });

   Route::get('/settings', function(){
      view('dashboard/settins');
   });

   Route::get('/profile', function(){
      view('dashboard/profile');
   });


})->prefix('/panel')->middlewares(['AuthMiddleware@session'])->setData(controller('PanelViewsController', 'userProfileData'));


Route::error(403, function(){
   Server::redirect('/');
});

Route::error(404, function(){
   import('middlewares/AuthMiddleware.php')->session() ?
   view('404', arrayToObject(['redirect' => '/panel/dashboard'])) : 
   view('404', arrayToObject(['redirect' => '/']));
});