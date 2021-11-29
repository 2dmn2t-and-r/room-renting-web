<?php
    namespace Controllers;
    require_once('models/Room.php');
    require_once('models/Reservation.php');
    require_once('models/User.php');
    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class ReservationController {
        public function uploadReservation() {
            $Reservation = 'Models\\Reservation';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $reservation = json_decode(file_get_contents('php://input'), true);
            $bookDate = date_create()->format('Y-m-d');
            $useDate = $reservation['useDate'];
            $startTime = $reservation['startTime'];
            $endTime = $reservation['endTime'];
            $totalPrice = $reservation['totalPrice'];
            $statusR = $reservation['statusR'];
            $roomId = $reservation['roomId'];
            $userId = $authorization['userId'];

            $available = $Reservation::checkAvailableTime($roomId, $useDate, $startTime, $endTime);
            if (!$available) {
                echo json_encode(['msg' => 'The room has been reserved in that time.', 'result'=>false, 'status'=>200]); 
                return;
            }

            $result = $Reservation::uploadReservation($bookDate, $useDate, $startTime, $endTime, $totalPrice, $statusR, $roomId, $userId);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function loadRoomReservations($id, $from, $to) {
            $Reservation = 'Models\\Reservation';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $type = $authorization['type'];
            if($type == 'C') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }
            
            $list = $Reservation::loadRoomReservations($id, $from, $to);
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadReservations($from, $to) {
            $Reservation = 'Models\\Reservation';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $type = $authorization['type'];
            if($type == 'C') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }

            $list = $Reservation::loadReservations($from, $to);
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadReservation() {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $Reservation = 'Models\\Reservation';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $list = $Reservation::loadReservation($userId);
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadIntervalReservation($from, $to) {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $Reservation = 'Models\\Reservation';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $list = $Reservation::loadReservation($userId, $from, $to);
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function removeReservation($id) {
            $Reservation = 'Models\\Reservation';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $result = $Reservation::removeReservation($id);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function setPayReservation($id) {
            $Reservation = 'Models\\Reservation';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $type = $authorization['type'];
            if($type == 'C') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }
            $result = $Reservation::setPayReservation($id);
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>