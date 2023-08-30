<?php


function scripts(){
    echo requiresStaticFiles([
      routePublic('libs/bootstrap/js/popper.min.js'),
      routePublic('vendor/bootstrap/js/bootstrap.bundle.min.js'),
    ]);
}
