<?php
    require_once('controllers/ExampleController.php');

    $router->get('/example', 'ExampleController.index');

?>