<?php


function head($title){
    ?> 
       <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php requiresStaticFiles([
            routePublic('vendor/bootstrap/css/bootstrap.min.css'),
            routePublic('assets/css/style.css'),
        ]) ?>
       </head> 
    <?php
}


function headerhtml(){
    ?> 
        <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="<?php route('/') ?>">F Technology</a>
          <!-- Booton de hamburguesa para el responsive device -->
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="navbar-toggler-icon"></i>
          </button>
          <!-- Fin del boton para pantallas pequenas -->
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" href="<?php route('/') ?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php route('/contact') ?>">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php route('/aboutus') ?>">Sobre nosotros</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php route('/faq') ?>">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php route('/store') ?>">Tienda</a>
              </li>
            </ul>            
            <button class="btn btn-outline-success" type="submit"><a href="<?php route('/login') ?>" style="color: inherit;">Login</a></button>
          </div>
        </div>
      </nav>
    </header>
    <?php
}


