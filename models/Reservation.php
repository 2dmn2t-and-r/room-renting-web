<?php    
    namespace Models;
    require_once('models/Room.php');
    require_once('models/User.php');

    class Reservation {
        public $resId;
        public $bookDate;
        public $useDate;
        public $startTime;
        public $endTime;
        public $totalPrice;
        public $statusR;
        public $roomId;
        public $userId;

        public function __construct($resId, $bookDate, $useDate, $startTime, $endTime, $totalPrice, $statusR, $roomId, $userId) {
            $this->resId = $resId;
            $this->bookDate = $bookDate;
            $this->useDate = $useDate;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->totalPrice = $totalPrice;
            $this->statusR = $statusR;
            $this->roomId = $roomId;
            $this->userId = $userId;
        }

        public static function checkAvailableTime($roomId, $useDate, $startTime, $endTime) {
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM reservation WHERE roomId=$roomId and useDate='$useDate' and ((startTime<='$startTime' and endTime>'$startTime') or (startTime<'$endTime' and endTime>='$endTime') or (startTime>='$startTime' and endTime<='$endTime'))";
            $available = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($available);
            if ($row) {
                return false;
            }
            else {
                return true;
            }
        }

        public static function uploadReservation($bookDate, $useDate, $startTime, $endTime, $totalPrice, $statusR, $roomId, $userId) {
            $db = 'Database'::getInstance();
            $query = "INSERT INTO reservation(bookDate, useDate, startTime, endTime, totalPrice, statusR, roomId, userId) VALUES ('$bookDate', '$useDate', '$startTime', '$endTime', '$totalPrice', '$statusR', '$roomId', '$userId')";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function loadReservation($userId, $from = null, $to = null) {
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';
            
            $query = "";
            if (!$from) {
                $query = "SELECT *, ro.address as ro_address, ro.type as ro_type
                            FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                            WHERE re.userId = $userId";
            }
            else {
                $query = "SELECT *, ro.address as ro_address, ro.type as ro_type
                            FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                            WHERE re.userId = $userId and re.useDate >= '$from' and re.useDate <= '$to'";
            }
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['ro_type'], $row['floor'], $row['seat'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            return $list;
        }

        public static function removeReservation($id) {
            $db = 'Database'::getInstance();
            $query = "DELETE FROM reservation WHERE resId = $id";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function setPayReservation($id) {
            $db = 'Database'::getInstance();
            $query = "UPDATE reservation SET statusR = 'P' WHERE resId = $id";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function loadRoomReservations($id, $from, $to) {
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address, ro.type as ro_type
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.roomId = $id and re.useDate >= '$from' and re.useDate <='$to'";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['ro_type'], $row['floor'], $row['seat'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            return $list;
        }

        public static function loadReservations($from, $to) {
            $db = 'Database'::getInstance();
            $Room = 'Models\\Room';
            $Reservation = 'Models\\Reservation';
            $User = 'Models\\User';

            $query = "SELECT *, ro.address as ro_address, ro.type as ro_type
                        FROM (reservation re join room ro on re.roomId = ro.roomId) join user usr on re.userId = usr.userId
                        WHERE re.useDate >= '$from' and re.useDate <= '$to'";
            $result = mysqli_query($db, $query);
            $i = 0;
            $list = [];
            while($row = mysqli_fetch_assoc($result)){
                $list[$i]['reservation'] = new $Reservation($row['resId'], $row['bookDate'], $row['useDate'], $row['startTime'], $row['endTime'], $row['totalPrice'], $row['statusR'], $row['roomId'], $row['userId']);
                $list[$i]['room'] = new $Room($row['roomId'], $row['roomName'], $row['ro_type'], $row['floor'], $row['seat'], $row['price'], $row['statusRo'], $row['openTime'], $row['closeTime'], $row['ro_address'], $row['description'], $row['image']);
                $list[$i]['user'] = new $User($row['userId'], $row['username'], '', $row['sex'], $row['birthday'], $row['phone'], $row['address'], '', $row['type'], $row['avatar']);
                $i++;
            }
            return $list;
        }
    }
?>
