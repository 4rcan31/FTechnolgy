<?php


class Modal{

    public static $id;
    

    public static function buttonModal($body){
        echo self::returnButtonModal($body);
    }

    public static function returnButtonModal($body, $newButton = null){
        self::$id = 'modal_token_'.token(2);
    
        if ($newButton === null) {
            $newButton = '<a class="dropdown-item btn btn-primary btn-icon-split btn-sm float-rsight" data-toggle="modal" data-target="#'.self::$id.'">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        '.$body.'
                    </a>';
        } else {
            // Encuentra la primera etiqueta de apertura de una etiqueta HTML
            preg_match('/<[^>]+>/', $newButton, $matches);
            if (!empty($matches)) {
                // Agrega el atributo data-target al primer elemento encontrado
                $newButton = str_replace($matches[0], str_replace(">", ' data-target="#'.self::$id.'" data-toggle="modal" >', $matches[0]), $newButton);
            } else {
                // Si no se encuentra ninguna etiqueta HTML, crea un enlace <a> con los atributos data-target y data-toggle
                $newButton = '<a class="dropdown-item btn btn-primary btn-icon-split btn-sm float-rsight" data-toggle="modal" data-target="#'.self::$id.'">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                '.$body.'
            </a>';
            }
        }
        
        return $newButton;
    }
    
    
    
    


    public static function create($title, $htmlBody, $buttonSaveText = false, $buttonExitText = 'Cerrar'){
        $idForm = "id_form_".token(32); 
        $idButton = "id_button_".token(32);
        preg_match('/<[^>]+>/', $htmlBody, $matches);
        if(!empty($matches)){
           $htmlBody = str_replace($matches[0], str_replace(">", ' id="'.$idForm.'" >', $matches[0]),$htmlBody);
        }
        ?>        
            <div class="modal fade" id="<?php echo self::$id ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo self::$id ?>Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?php echo self::$id ?>LongTitle"><?php echo $title ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $htmlBody ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id = "<?php echo 'idButton'.self::$id ?>"><?php echo $buttonExitText ?></button>
                        <?php if($buttonSaveText): ?>
                            <button type="button" class="btn btn-primary" id="<?php echo $idButton ?>"><?php echo $buttonSaveText ?></button>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php
        if($buttonExitText){
            ?> 
                <script>
                    const buttonSend = document.getElementById(<?php echo json_encode($idButton) ?>);
                    const form = document.getElementById(<?php echo json_encode($idForm) ?>);
                    buttonSend.addEventListener('click', function(event) {
                        event.preventDefault();
                        form.submit();
                    });
                </script>
            <?php
        }
    }


    public function getIdButtonSaveModal(){
        return 'idButton'.self::$id;
    }

}