<?php
    require_once('controllers/NewsController.php');

    $router->get('/news/load', 'NewsController.loadNewsList');

    $router->get('/news/load/{id}', 'NewsController.loadNews');

    $router->get('/news/comments/load/{id}', 'NewsController.loadNewsComments');

    $router->post('/news/upload', 'NewsController.uploadNews');

    $router->post('/news/comment/upload', 'NewsController.uploadNewsComment');

    $router->post('/news/comment/delete', 'NewsController.deleteNewsComment');
?>