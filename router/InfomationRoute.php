<?php
    require_once('controllers/InfomationController.php');

    $router->get('/info', 'InfomationController.loadInfo');

    $router->post('/info', 'InfomationController.uploadInfo');
?>