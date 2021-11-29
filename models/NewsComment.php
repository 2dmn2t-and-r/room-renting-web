<?php    
    namespace Models;

    use DateTime;

    class NewsComment {
        public int $commentId;
        public int $newId;
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

        public static function loadNewsComments($id) {
            $db = 'Database'::getInstance();
            $query =   "SELECT commentId, date, content, newsId, userId, username, avatar 
                        FROM WEB_DATABASE.NEWS_COMMENT NATURAL JOIN WEB_DATABASE.USER 
                        WHERE newsId = '$id'";
            $newscomments = mysqli_query($db, $query);
            $row = mysqli_fetch_all($newscomments, MYSQLI_ASSOC);
            return $row;
        }

        public static function uploadNewsComment(
            $option,
            $commentId, $date, $content, $newsId, $userId
        ) {
            $db = 'Database'::getInstance();
            $query = "";
            if($option = 'C') {
                $query =   "INSERT INTO WEB_DATABASE.NEWS_COMMENT (date, content, newsId, userId)
                            VALUES ('$date', '$content', '$newsId', '$userId')";
            } else {
                $query =   "UPDATE WEB_DATABASE.NEWS_COMMENT
                            SET date = '$date', content = '$content'
                            WHERE commentId = '$commentId' AND newsId = '$newsId' AND userId = '$userId'";
            }
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function deleteNewsComment(
            $option,
            $commentId, $userId,
        ) {
            $db = 'Database'::getInstance();
            $query = "";
            if($option == "M") {
                $query =   "DELETE FROM WEB_DATABASE.NEWS_COMMENT
                            WHERE commentId = '$commentId'";
            } else {
                $query =   "DELETE FROM WEB_DATABASE.NEWS_COMMENT
                            WHERE commentId = '$commentId' AND userId = '$userId'";
            }
            $result = mysqli_query($db, $query);
            return $result;
        }
    }
?>