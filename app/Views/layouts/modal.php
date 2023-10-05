<?php


class Modal{

    public static $id;
    

    public static function buttonModal($body, $executeModal = false, $modalConfig = []){
        echo self::returnButtonModal($body);
        $executeModal ? self::create(
            $modalConfig['title'],
            $modalConfig['html']
        ) : null;
    }

    public static function returnButtonModal($body, $newButton = null, $print = false){
        self::$id = 'modal_token_'.token(2);
    
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

            return $print ? print($newButton) : $newButton;
    }

    public static function returnButtonModal2($body, $newButton = null){
        self::$id = 'modal_token_'.token(2);
        
        // Verifica si $body es una cadena no nula y contiene un formato HTML
        if ($body !== null && preg_match('/<[^>]+>/', $body)) {
            // Agrega los atributos data-toggle y data-target al contenido HTML de $body
            $body = preg_replace('/<[^>]+>/', '$0 data-toggle="modal" data-target="#'.self::$id.'"', $body);
        } else {
            // Si $body es nulo o no contiene formato HTML, utiliza el contenido por defecto
            $body = '<a class="dropdown-item btn btn-primary btn-icon-split btn-sm float-right" data-toggle="modal" data-target="#'.self::$id.'">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                '.$body.'
            </a>';
        }
    
        return $body;
    }
    
    

    
    
    


    public static function create($title, $htmlBody, $buttonSaveText = false, $buttonExitText = 'Cerrar'){
        $idForm = "id_form_".token(5); 
        $idButton = "id_button_".token(5);
        /* 
            Este código busca un formulario dentro de todo el contenido HTML en $htmlBody. Si se encuentra un formulario,
            agrega un atributo "id" a ese formulario. Si no se encuentra un formulario, agrega el atributo "id" a la primera etiqueta HTML que encuentre.
        */
        $htmlBody = strpos($htmlBody, '<form') !== false ? 
        preg_replace('/<form([^>]*)>/', '<form$1 id="' . $idForm . '">', $htmlBody, 1) : 
        preg_replace('/<[^>]+>/', '$0 id="' . $idForm . '"', $htmlBody, 1);
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
                const buttonSend_<?php echo $idButton ?> = document.getElementById(<?php echo json_encode($idButton) ?>);
                const form_<?php echo $idForm ?> = document.getElementById(<?php echo json_encode($idForm) ?>);
                buttonSend_<?php echo $idButton ?>.addEventListener('click', function(event) {
                    event.preventDefault();
                    form_<?php echo $idForm ?>.submit();
                });
            </script>
            <?php
            
        }
    }

}