<?php
    require_once('controllers/NewsController.php');

    $router->get('/news/load', 'NewsController.loadNews');

    $router->post('/news/upload', 'NewsController.uploadNews');
?>