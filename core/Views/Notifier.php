<?php


class NotifierPHP{

    public static $inputs;
    public static $data;

    public static function send(string $rute, array $data, $type){
        $data = base64_encode(json_encode([
            'header' => [
                'type' => $type
            ],
            'body' => $data
        ]));
        session_start();
        $_SESSION['senddata'] = $data;
        header('Location: '.$rute);
        exit;
    }
    
    

    public static function isThere(){
        if(isset($_SESSION['senddata'])){
            self::$data = $_SESSION['senddata'];
            return true;
        }
        return false;
    }

    public static function get($json = false){
        if(self::isThere()){
            return $json ? base64_decode(self::$data) : json_decode(base64_decode(self::$data));
        }
        return null;
    }

    public static function print(){
        if(self::isThere()){
            $type = self::get()->header->type;
            $body = self::get()->body;
            $delay = 300; // Milisegundos de retraso entre toasts
            $verticalOffset = 0;
            $i = 0;
            foreach($body as $data){
                $i++;
                $toastHeight = self::getToastHeight($data); // Obtener la altura de la notificación
                echo self::toast($type, $data, $i, $delay * ($i/5), $verticalOffset, $toastHeight);
                $verticalOffset += $toastHeight + 20; // Incrementar el offset vertical según la altura de la notificación
            }
        }
    }

    public static function setValuesInputs() {
        unset($_SESSION['inputs']['csrf_token']);
        if(isset($_SESSION['inputs'])){
            foreach ($_SESSION['inputs'] as $name => $value) {
                ?> 
                <script>
                    var inputElement = document.querySelector('input[name=' + <?php echo json_encode($name) ?> + ']');
                    inputElement.value = <?php echo json_encode($value) ?>;
                </script>
                <?php
            }
        }
    }
    

    public static function destroyData(){
        unset($_SESSION['senddata']);
        unset($_SESSION['inputs']);
    }

    public static function setInputs($inputs){
        session_start();
        $_SESSION['inputs'] = $inputs;
        return 0;
    }
    
    public static function toast(string $title, string $body, $id, $delay, $verticalOffset, $toastHeight, $time = 'now', $img = ''){
        if(!empty($img)){ $img = '<img src="'.$img.'" class="rounded me-2">'; }
        $toastId = 'toast_' . $id; // Generar un ID único
    
        return '<div class="toast-container" style="position: fixed; top:'.$verticalOffset.'px; right: 0; margin: 10px;">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="'.$toastId.'">
              <div class="toast-header">
                '.$img.'
                <strong class="me-auto">'.$title.'</strong>
                <small class="text-muted">'.$time.'</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body" style="max-height: '.$toastHeight.'px; overflow-y: auto;">
                '.$body.'
              </div>
            </div>
          </div>
          <script>
          setTimeout(function() {
              var myAlert = document.getElementById("'.$toastId.'"); 
              var bsAlert = new bootstrap.Toast(myAlert); 
              bsAlert.show(); 
          }, '.$delay.');
          </script>';
    }
    
    public static function getToastHeight($content){
        if(strlen($content) > 50){
            return 90;
        }else if(strlen($content) < 50){
            return 70;
        }else{
            return 200;
        }
    }
}