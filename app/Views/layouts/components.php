<?php


function pageHending($name, $button = false, $buttonName = ""){
    ?> 
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $name ?></h1>
                        <?php if($button): ?>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i><?php echo $buttonName ?></a>
                        <?php endif; ?>
                    </div>
    <?php
}


/* 
    $type => [
        primary,
        success,
        warning
        info
    ]
    $ico tiene que se de "fas fa"
*/
function card($title, $body, $ico, $type = 'primary', $in = 4, $redirect = '#'){
    $colClass = 'col-xl-' . (12 / $in) . ' col-md-6 mb-4';
    $id = 'card_token_'.token();
    ?> 
    <div class="<?php echo $colClass ?>" id="<?php echo $id ?>">
        <div class="card border-left-<?php echo $type ?> shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-<?php echo $type ?> text-uppercase mb-1">
                            <?php echo $title ?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $body ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-<?php echo $ico ?> fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById(<?php echo json_encode($id) ?>).addEventListener('click', function(){
           location.href = <?php echo json_encode($redirect) ?>
        });
    </script>
    <?php
}



function cardWithGraphic($title, $porcent,$ico, $type = 'primary'){
    ?> 
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?php echo $type ?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?php echo $type ?> text-uppercase mb-1"><?php echo $title ?>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $porcent ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-<?php echo $type ?>" role="progressbar"
                                                            style="width: <?php echo $porcent ?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-<?php echo $ico ?> fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <?php
}




