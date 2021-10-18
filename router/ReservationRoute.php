<?php
    require_once('controllers/ReservationController.php');

    $router->post('/reservation/upload', 'ReservationController.uploadReservation');

    $router->get('/reservation/loadUser', 'ReservationController.loadUserReservations');

    $router->get('/reservation/loadRoom', 'ReservationController.loadRoomReservations');
    
    $router->get('/reservation/load', 'ReservationController.loadReservation');
?>