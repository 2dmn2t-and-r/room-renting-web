<?php
    require_once('controllers/ReservationController.php');

    $router->post('/reservation/upload', 'ReservationController.uploadReservation');

    $router->get('/reservation/loadUser/{id}/{from}/{to}', 'ReservationController.loadUserReservations');

    $router->get('/reservation/loadRoom/{id}/{from}/{to}', 'ReservationController.loadRoomReservations');
    
    $router->get('/reservation/load/{from}/{to}', 'ReservationController.loadReservations');

    $router->get('/reservation/individual', 'ReservationController.loadReservation');
?>