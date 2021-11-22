<?php
    require_once('controllers/RoomController.php');

    $router->get('/rooms/load/{type}', 'RoomController.loadRooms');

    $router->get('/room/load/{id}', 'RoomController.loadRoom');

    $router->post('/room/delete', 'RoomController.deleteRoom');

    $router->get('/room/comments/load/{id}', 'RoomController.loadRoomComments');

    $router->post('/room/upload', 'RoomController.uploadRoom');

    $router->post('/room/comment/upload', 'RoomController.uploadRoomComment');

    $router->post('/room/comment/delete', 'RoomController.deleteRoomComment');
?>