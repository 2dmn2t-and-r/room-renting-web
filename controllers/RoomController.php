<?php
    namespace Controllers;


    require_once('models/Room.php');

    class RoomController {
        public function loadRooms($type) {
            if (!in_array($type, ["hall", "meeting_room", "stage"])) {
                echo json_encode(['msg' => 'Invalid room type.', 'status'=>401]); 
                return;
            }
            $Room = 'Models\\Room';
            $db = 'Database'::getInstance();
            $roomType = strtoupper(substr($type, 0, 1));
            $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE type = '$roomType'";
            $rooms = mysqli_query($db, $query);
            $row = mysqli_fetch_all($rooms, MYSQLI_ASSOC);
            
            echo json_encode(['rooms'=>$row, 'status'=>200]);
        }

        public function loadRoom($id) {
            $Room = 'Models\\Room';
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE roomId = '$id'";
            $room = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($room);
            if(!$row) {
                echo json_encode(['msg' => 'Invalid room ID.', 'status'=>401]); 
                return;
            }
            echo json_encode(['room'=>$row, 'status'=>200]);
        }

        public function uploadRoom() {
            $Room = 'Models\\Room';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $type = $authorization['type'];
            if($type != 'M') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }

            $db = 'Database'::getInstance();

            $room = json_decode(file_get_contents('php://input'), true);
            $roomName = $room['roomName'];
            $roomType = $room['type'];
            $floor = $room['floor'];
            $price = $room['price'];
            $statusRo = $room['statusRo'];
            $openTime = $room['openTime'];
            $closeTime = $room['closeTime'];
            $address = $room['address'];
            $description = $room['description'];
            $image = $room['image'];

            if (array_key_exists('roomId', $room)) {
                $roomId = $room['roomId'];
                $query =   "UPDATE WEB_DATABASE.ROOM
                            SET roomName = '$roomName', type = '$roomType', floor = '$floor', price = '$price', statusRo = '$statusRo', openTime= '$openTime', closeTime = '$closeTime', address = '$address', description = '$description', image = '$image'
                            WHERE roomId = '$roomId';";
            }
            else {
                $query =   "INSERT INTO WEB_DATABASE.ROOM (roomName, type, floor, price, statusRo, openTime, closeTime, address, description, image)
                            VALUES ('$roomName', '$roomType', '$floor', '$price', '$statusRo', '$openTime', '$closeTime', '$address', '$description', '$image')";
            }

            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>