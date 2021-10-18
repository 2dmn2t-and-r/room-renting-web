<?php
    require_once("config.php");
    require_once("router.php");

    $router = new Route();
    
    require_once('router/ExampleRoute.php');
    require_once('router/RoomRoute.php');
    require_once('router/ReservationRoute.php');
    require_once('router/NewsRoute.php');
    require_once('router/AuthenticationRoute.php');
    
    $request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';
    $method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

    $router->map($request_url, $method_url);
?>

