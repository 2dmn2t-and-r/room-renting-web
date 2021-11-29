<?php    
    namespace Models;

    class Room {
        public $roomId;
        public $roomName;
        public $type;
        public $floor;
        public $seat;
        public $price;
        public $statusRo;
        public $openTime;
        public $closeTime;
        public $address;
        public $description;
        public $image;

        public function __construct($roomId, $roomName, $type, $floor, $seat, $price, $statusRo, $openTime, $closeTime, $address, $description, $image) {
            $this->roomId = $roomId;
            $this->roomName = $roomName;
            $this->type = $type;
            $this->floor = $floor;
            $this->seat = $seat;
            $this->price = $price;
            $this->statusRo = $statusRo;
            $this->openTime = $openTime;
            $this->closeTime = $closeTime;
            $this->address = $address;
            $this->description = $description;
            $this->image = $image;
        }

        public static function loadRooms($roomType) {
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE type = '$roomType' AND statusRo <> 'R'";
            $rooms = mysqli_query($db, $query);
            $row = mysqli_fetch_all($rooms, MYSQLI_ASSOC);
            return $row;
        }

        public static function loadRoom($id) {
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE roomId = '$id'";
            $room = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($room);
            return $row;
        }

        public static function createRoom(
            $roomName,
            $roomType,
            $floor,
            $seat,
            $price,
            $statusRo,
            $openTime,
            $closeTime,
            $address,
            $description,
            $image,
        ) {
            $db = 'Database'::getInstance();
            $query =   "INSERT INTO WEB_DATABASE.ROOM (roomName, type, floor, price, seat, statusRo, openTime, closeTime, address, description, image)
                        VALUES ('$roomName', '$roomType', '$floor', '$price', '$seat', '$statusRo', '$openTime', '$closeTime', '$address', '$description', '$image')";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function updateRoom(
            $roomId,
            $roomName,
            $roomType,
            $floor,
            $seat,
            $price,
            $statusRo,
            $openTime,
            $closeTime,
            $address,
            $description,
            $image,
        ) {
            $db = 'Database'::getInstance();
            $query =   "UPDATE WEB_DATABASE.ROOM
                        SET roomName = '$roomName', type = '$roomType', floor = '$floor', price = '$price', seat = '$seat', statusRo = '$statusRo', openTime= '$openTime', closeTime = '$closeTime', address = '$address', description = '$description', image = '$image'
                        WHERE roomId = '$roomId';";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function deleteRoom($roomId) {
            $db = 'Database'::getInstance();
            $query =   "UPDATE WEB_DATABASE.ROOM
                        SET statusRo = 'R'
                        WHERE roomId = '$roomId';";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function getAvailableTime($id, $useDate) {
            $db = 'Database'::getInstance();
            $query =   "select timeframe
                        from TIMELINE 
                        where (
                            select count(*)
                            from RESERVATION 
                            where roomId = $id and useDate = '$useDate' and startTime <= timeframe and timeframe < endTime
                        ) = 0";
            $timeframes = mysqli_query($db, $query);
            $row = mysqli_fetch_all($timeframes, MYSQLI_ASSOC);
            return $row;
        }
    }
?>
