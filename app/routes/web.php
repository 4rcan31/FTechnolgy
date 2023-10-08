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

   Route::get('/croquette/%token', function($request){
      controller('CroquetteController', 'view', $request);
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
      controller('PanelViewsController', 'pageProfile');
   });

   Route::get('/template', function(){
      view('dashboard/homeexample');
   });

   Route::get('/store', function(){
      controller('PanelViewsController', 'store');
   });

   Route::get('/orders', function(){
      controller('PanelViewsController', 'ordersView');
   });

   Route::get('/faq', function(){
      controller('PanelViewsController', 'faqView');
   });


})->prefix('/panel')->middlewares(['AuthMiddleware@session'])->setData(controller('PanelViewsController', 'userProfileData'));
/* 
   La función 'setData' se utiliza con un dato de sesión específico del servidor en el contexto del controlador de vistas 'PanelViewsController'. 
   Es importante considerar que si esta ruta se llama desde otro lugar donde dicho dato de sesión
   no esté disponible en la solicitud (request), podría generar un error, ya que el dato de sesión no existirá en ese contexto. Para evitar problemas,
   es necesario verificar la existencia de este dato de sesión antes de utilizarlo en el controlador.
*/



Route::error(403, function(){
   Server::redirect('/');
});

Route::error(404, function(){
   import('middlewares/AuthMiddleware.php')->session() ?
   view('404', arrayToObject(['redirect' => '/panel/dashboard'])) : 
   view('404', arrayToObject(['redirect' => '/']));
});