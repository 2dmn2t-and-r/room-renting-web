<?php
    require_once('controllers/RoomController.php');

    $router->get('/rooms', 'RoomController.loadRooms');

    $router->get('/room', 'RoomController.loadRoom');

    $router->post('/room/upload', 'RoomController.uploadRoom');
?>