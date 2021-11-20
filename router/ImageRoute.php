<?php
    require_once('controllers/ImageController.php');

    $router->get('/image/load', 'ImageController.getAuthenEndPoint');
    
?>