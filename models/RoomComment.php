<?php    
    namespace Models;

    use DateTime;

    class RoomComment {
        public int $commentId;
        public int $roomId;
        public string $ownerName;
        public string $ownerId;
        public string $ownerImage;
        public string $content;
        public DateTime $date;

        public function __construct(
            int $commentId,
            int $roomId,
            string $ownerName,
            string $ownerId,
            string $ownerImage,
            string $content,
            DateTime $date
        ) {
            $this->commentId = $commentId;
            $this->roomId = $roomId;
            $this->ownerName = $ownerName;
            $this->ownerId = $ownerId;
            $this->ownerImage = $ownerImage;
            $this->content = $content;
            $this->date = $date; 
        }

        public static function loadRoomComments($id) {
            $db = 'Database'::getInstance();
            $query =   "SELECT commentId, date, content, roomId, userId, username, avatar 
                        FROM WEB_DATABASE.ROOM_COMMENT NATURAL JOIN WEB_DATABASE.USER 
                        WHERE roomId = '$id'";
            $roomcomments = mysqli_query($db, $query);
            $row = mysqli_fetch_all($roomcomments, MYSQLI_ASSOC);
            return $row;
        }

        public static function updateRoomComment($commentId, $date, $content, $roomId, $userId) {
            $db = 'Database'::getInstance();
            $$query =  "UPDATE WEB_DATABASE.ROOM_COMMENT
                        SET date = '$date', content = '$content'
                        WHERE commentId = '$commentId' AND roomId = '$roomId' AND userId = '$userId'";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function createRoomComment($date, $content, $roomId, $userId) {
            $db = 'Database'::getInstance();
            $query =   "INSERT INTO WEB_DATABASE.ROOM_COMMENT (date, content, roomId, userId)
                        VALUES ('$date', '$content', '$roomId', '$userId')";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function deleteRoomComment($type, $commentId, $userId) {
            $db = 'Database'::getInstance();
            if($type == 'M') {
                $query =   "DELETE FROM WEB_DATABASE.ROOM_COMMENT
                            WHERE commentId = '$commentId'";
            }
            else {
                $query =   "DELETE FROM WEB_DATABASE.ROOM_COMMENT
                            WHERE commentId = '$commentId' AND userId = '$userId'";
            }

            $result = mysqli_query($db, $query);
            return $result;
        }
    }
?>