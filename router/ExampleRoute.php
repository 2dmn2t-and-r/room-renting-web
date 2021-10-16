<?php
    require_once('controllers/ExampleController.php');

    $router->get('/', 'ExampleController.index');

    $router->get('/data', function() {
        echo 'data';
    });
?>