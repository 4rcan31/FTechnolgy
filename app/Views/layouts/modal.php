<?php


class Modal{

    public static $id;
    

    public static function buttonModal($body){
        echo self::returnButtonModal($body);
    }

    public static function returnButtonModal($body){
        self::$id = 'modal_token_'.token(2);
        return '<a class="dropdown-item btn btn-primary btn-lg" data-toggle="modal" data-target="#'.self::$id.'">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    '.$body.'
                </a>';
    }


    public static function create($title, $htmlBody, $buttonSaveText = false, $buttonExitText = 'Cerrar'){
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
                            <button type="button" class="btn btn-primary"><?php echo $buttonSaveText ?></button>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }


    public function getIdButtonSaveModal(){
        return 'idButton'.self::$id;
    }

}