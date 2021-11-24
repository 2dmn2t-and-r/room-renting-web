<?php
    namespace Controllers;

    use mysqli_result;

    require_once('models/Room.php');
    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class RoomController {
        public function loadRooms($type) {
            $Room = 'Models\\Room';
            if (!in_array($type, ["hall", "meeting_room", "stage"])) {
                echo json_encode(['msg' => 'Invalid room type.', 'status'=>401]); 
                return;
            }
            // $VerifyAccount = 'Middlewares\\VerifyAccount';
            // $authorization = $VerifyAccount::checkAuthState();
            // $type = $authorization['type'];

            $db = 'Database'::getInstance();
            $roomType = strtoupper(substr($type, 0, 1));

            $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE type = '$roomType' AND statusRo <> 'R'";
            // if ($type == 'M') {
            //     $query = "SELECT * FROM WEB_DATABASE.ROOM WHERE type = '$roomType'";
            // }

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
            $seat = $room['seat'];
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
                            SET roomName = '$roomName', type = '$roomType', floor = '$floor', price = '$price', seat = '$seat', statusRo = '$statusRo', openTime= '$openTime', closeTime = '$closeTime', address = '$address', description = '$description', image = '$image'
                            WHERE roomId = '$roomId';";
            }
            else {
                $query =   "INSERT INTO WEB_DATABASE.ROOM (roomName, type, floor, price, seat, statusRo, openTime, closeTime, address, description, image)
                            VALUES ('$roomName', '$roomType', '$floor', '$price', '$seat', '$statusRo', '$openTime', '$closeTime', '$address', '$description', '$image')";
            }

            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function deleteRoom() {
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
            $room = json_decode(file_get_contents('php://input'), true);
            $roomId = $room['roomId'];

            $query =   "UPDATE WEB_DATABASE.ROOM
                        SET statusRo = 'R'
                        WHERE roomId = '$roomId';";
            $db = 'Database'::getInstance();
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function loadRoomComments($id) {
            $RoomComment = 'Models\\RoomComment';
            $db = 'Database'::getInstance();

            $query =   "SELECT commentId, date, content, roomId, userId, username, avatar 
                        FROM WEB_DATABASE.ROOM_COMMENT NATURAL JOIN WEB_DATABASE.USER 
                        WHERE roomId = '$id'";
            $roomcomments = mysqli_query($db, $query);
            $row = mysqli_fetch_all($roomcomments, MYSQLI_ASSOC);
            echo json_encode(['room_comments'=>$row, 'status'=>200]);
        }

        public function uploadRoomComment() {
            $RoomComment = 'Models\\RoomComment';
            $VerifyAccount = 'Middlewares\\VerifyAccount';

            $authorization = $VerifyAccount::checkAuthState();
            
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $comment = json_decode(file_get_contents('php://input'), true);
            
            $date = $comment["date"]; 
            $content = $comment["content"];
            $roomId = $comment["roomId"]; 
            $userId = $authorization['userId'];

            $type = $authorization['type'];

            $db = 'Database'::getInstance();
            
            if (array_key_exists('commentId', $comment)) {
                $commentId = $comment["commentId"]; 
                $query =   "UPDATE WEB_DATABASE.ROOM_COMMENT
                            SET date = '$date', content = '$content'
                            WHERE commentId = '$commentId' AND roomId = '$roomId' AND userId = '$userId'";
            }
            else {
                $query =   "INSERT INTO WEB_DATABASE.ROOM_COMMENT (date, content, roomId, userId)
                            VALUES ('$date', '$content', '$roomId', '$userId')";
            }

            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function deleteRoomComment() {
            $RoomComment = 'Models\\RoomComment';
            $VerifyAccount = 'Middlewares\\VerifyAccount';

            $authorization = $VerifyAccount::checkAuthState();
            
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $comment = json_decode(file_get_contents('php://input'), true);
            
            $commentId = $comment["commentId"];

            $userId = $authorization['userId'];
            $type = $authorization['type'];
            if($type == 'M') {
                $query =   "DELETE FROM WEB_DATABASE.ROOM_COMMENT
                            WHERE commentId = '$commentId'";
            }
            else {
                $query =   "DELETE FROM WEB_DATABASE.ROOM_COMMENT
                            WHERE commentId = '$commentId' AND userId = '$userId'";
            }
            $db = 'Database'::getInstance();
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>