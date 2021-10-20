<?php
    namespace Controllers;
    require_once('models/Room.php');
    require_once('models/Reservation.php');
    require_once('models/User.php');
    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class ReservationController {
        public function uploadReservation() {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $db = 'Database'::getInstance();
            $reservation = json_decode(file_get_contents('php://input'), true);
            $bookDate = date_create()->format('Y-m-d');
            $useDate = $reservation['useDate'];
            $startTime = $reservation['startTime'];
            $endTime = $reservation['endTime'];
            $totalPrice = $reservation['totalPrice'];
            $statusR = $reservation['statusR'];
            $roomId = $reservation['roomId'];
            $userId = $authorization['userId'];
            $query = "SELECT * FROM reservation WHERE roomId=$roomId and useDate='$useDate' and ((startTime<='$startTime' and endTime>'$startTime') or (startTime<'$endTime' and endTime>='$endTime'))";
            $available = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($available);
            if($row) {
                echo json_encode(['msg' => 'The room has been reserved in that time.', 'result'=>false, 'status'=>200]); 
                return;
            }
            $query = "INSERT INTO reservation(bookDate, useDate, startTime, endTime, totalPrice, statusR, roomId, userId) VALUES ('$bookDate', '$useDate', '$startTime', '$endTime', '$totalPrice', '$statusR', '$roomId', '$userId')";
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function loadUserReservations($id, $from, $to) {
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
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.userId = $id and re.useDate >= '$from' and re.useDate <='$to'";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['type'], $row['floor'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadRoomReservations($id, $from, $to) {
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
            
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.roomId = $id and re.useDate >= '$from' and re.useDate <='$to'";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['type'], $row['floor'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadReservations($from, $to) {
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

            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.useDate >= '$from' and re.useDate <= '$to'";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['type'], $row['floor'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }

        public function loadReservation() {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.userId = $userId";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['type'], $row['floor'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            echo json_encode(['reversations'=>$list, 'status'=>200]);
        }
    }
?>