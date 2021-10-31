<?php
    require_once('controllers/NewsController.php');

    $router->get('/news/load', 'NewsController.loadNewsList');

    $router->get('/news/load/{id}', 'NewsController.loadNews');

    $router->post('/news/upload', 'NewsController.uploadNews');
?>