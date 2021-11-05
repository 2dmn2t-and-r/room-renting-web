<?php
    require_once('controllers/AuthenticationController.php');

    $router->post('/auth/register', 'AuthenticationController.register');

    $router->post('/auth/login', 'AuthenticationController.login');

    $router->get('/auth/get', 'AuthenticationController.getUser');

    $router->post('/auth/changePassword', 'AuthenticationController.changePassword');

    $router->post('/auth/uploadProfile', 'AuthenticationController.uploadProfile');

    $router->get('/auth/loadProfile/{id}', 'AuthenticationController.loadProfile');
?>