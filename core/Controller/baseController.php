<?php 


class BaseController{

    public function validateCsrfTokenWithRedirection($request, $redirectTo)
    {
        csrf();
        if (!TokenCsrf::validateToken($request)) {
            Form::send($redirectTo, ['Su sesión ha expirado'], 'Error');
        }
        return;
    }
    
    
}