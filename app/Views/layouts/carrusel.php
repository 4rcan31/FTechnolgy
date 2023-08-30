<?php


function carrusel(){
    ?> 
    
    <div id="carouselPrincipal" class="carousel slide" data-bs-ride="carousel">

<!-- Inicio de botones de la parte inferior del carosel -->
<div class="carousel-indicators">
  <button
    type="button"
    data-bs-target="#carouselPrincipal"
    data-bs-slide-to="0"
    class="active"
    aria-current="true"
    aria-label="Slide 1"
  ></button>
  <button
    type="button"
    data-bs-target="#carouselPrincipal"
    data-bs-slide-to="1"
    aria-label="Slide 2"
  ></button>
  <button
    type="button"
    data-bs-target="#carouselPrincipal"
    data-bs-slide-to="2"
    aria-label="Slide 3"
  ></button>
</div>
<!-- Fin de botones de la parte inferior media del carousel -->



<!-- Inicio del contenido del carousel -->
<div class="carousel-inner">


    <!-- Inicio del primer slide (imagen) del carousel (Esta activo por defecto) -->
  <div class="carousel-item active">
    <img src="<?php echo routePublic('assets/images/EjemploDispensador.jpg') ?>" alt="" class="imgCarousel">
    <div class="container">
      <div class="carousel-caption text-start">
        <h1>FTechnology trabaja para</h1>
        <p>
          Que la felicidad de ellos sea tu tranquilidad
        </p>
        <p>
          <a class="btn btn-lg btn-primary" href="<?php route('/register') ?>">Regístrate hoy</a>
        </p>
      </div>
    </div>
  </div>
  <!-- Fin del primer slide del carousel -->


  <!-- Inicio del segundo slide (imagen) del carousel -->
  <div class="carousel-item">
    <img src="<?php echo routePublic('assets/images/EjemploDispensador4.jpeg') ?>" alt="" class="imgCarousel">
    <div class="container">
      <div class="carousel-caption text-start">
        <h1>FTechnology</h1>
        <p>
          FT, serving convenience one bawl at a time
        </p>
        <p>
          <a class="btn btn-lg btn-primary" href="<?php route('/aboutus') ?>">Más información</a>
        </p>
      </div>
    </div>
  </div>
  <!-- Fin del segundo slide del carousel -->



  <!-- Inicio del tercer slide del carousel -->
  <div class="carousel-item">
    <img src="<?php echo routePublic('assets/images/Dueño.jpg') ?>" alt="" class="imgCarousel">
    <div class="container">
      <div class="carousel-caption text-start">
        <h1>Con FTechnology</h1>
        <p>
          Conectate a ellos con un solo clic
        </p>
        <p>
          <a class="btn btn-lg btn-primary" href="<?php route('/store') ?>"
            >Explorar tienda</a
          >
        </p>
      </div>
    </div>
  </div>
  <!-- Fin del tercer slide del carousel -->


  
</div>
<!-- Fin del contenido del carousel -->


<!-- Inicio del boton de anterior -->
<button
  class="carousel-control-prev"
  type="button"
  data-bs-target="#carouselPrincipal"
  data-bs-slide="prev"
>
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Anterior</span>
</button>
<!-- Fin del boton de anterior -->


<!-- Inicio del boton de siguiente -->
<button
  class="carousel-control-next"
  type="button"
  data-bs-target="#carouselPrincipal"
  data-bs-slide="next"
>
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Siguiente</span>
</button>
<!-- Fin del boton de Siguiente -->



</div>
    <?php
}