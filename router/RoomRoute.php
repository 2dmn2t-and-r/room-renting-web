<?php
    require_once('controllers/RoomController.php');

    $router->get('/rooms/load/{type}', 'RoomController.loadRooms');

    $router->get('/room/load/{id}', 'RoomController.loadRoom');

    $router->post('/room/upload', 'RoomController.uploadRoom');
?>