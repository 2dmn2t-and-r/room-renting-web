<?php
    namespace Controllers;
    use mysqli_result;

    require_once('models/Room.php');
    require_once('models/RoomComment.php');
    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class RoomController {
        public function loadRooms($type) {
            $Room = 'Models\\Room';
            if (!in_array($type, ["hall", "meeting_room", "stage"])) {
                echo json_encode(['msg' => 'Invalid room type.', 'status'=>401]); 
                return;
            }
            $roomType = strtoupper(substr($type, 0, 1));

            $row = $Room::loadRooms($roomType);
            
            echo json_encode(['rooms'=>$row, 'status'=>200]);
        }

        public function loadRoom($id) {
            $Room = 'Models\\Room';
            $db = 'Database'::getInstance();
            $row = $Room::loadRoom($id);
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
            
            $result = false;

            if (array_key_exists('roomId', $room)) {
                $roomId = $room['roomId'];
                $result = $Room::updateRoom($roomId, $roomName, $roomType, $floor, $seat, $price, $statusRo, $openTime, $closeTime, $address, $description, $image);
            }
            else {
                $result = $Room::createRoom($roomName, $roomType, $floor, $seat, $price, $statusRo, $openTime, $closeTime, $address, $description, $image);
            }

            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function deleteRoom() {
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
            $room = json_decode(file_get_contents('php://input'), true);
            $roomId = $room['roomId'];

            $result = $Room::deleteRoom($roomId);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function loadRoomComments($id) {
            $RoomComment = 'Models\\RoomComment';

            $row = $RoomComment::loadRoomComments($id);
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

            $result = false;
            
            if (array_key_exists('commentId', $comment)) {
                $commentId = $comment["commentId"];
                $result = $RoomComment::updateRoomComment($commentId, $date, $content, $roomId, $userId);
            }
            else {
                $result = $RoomComment::createRoomComment($date, $content, $roomId, $userId);
            }

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
            $result = $RoomComment::deleteRoomComment($type, $commentId, $userId);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function getAvailableTime($id, $useDate) {
            $Room = 'Models\\Room';
            $VerifyAccount = 'Middlewares\\VerifyAccount';

            $authorization = $VerifyAccount::checkAuthState();
            
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $row = $Room::getAvailableTime($id, $useDate);
            echo json_encode(['timeframes'=>$row, 'status'=>200]);
        }
    }
?>