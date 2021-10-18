<?php
    namespace Controllers;
    require_once('models/Room.php');
    require_once('models/Reservation.php');
    require_once('models/User.php');

    class ReservationController {
        public function uploadReservation() {
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';
            
            $request_body = json_decode(file_get_contents('php://input'), true);
        }

        public function loadUserReservations() {
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';
            
            $request_body = json_decode(file_get_contents('php://input'), true);
        }

        public function loadRoomReservations() {
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $request_body = json_decode(file_get_contents('php://input'), true);
        }

        public function loadReservations() {
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $request_body = json_decode(file_get_contents('php://input'), true);
        }
    }
?>