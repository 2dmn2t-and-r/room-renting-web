<?php    
    namespace Models;

    class News {
        public $newsId;
        public $title;
        public $createDate;
        public $modifyDate;
        public $content;
        public $image;

        public function __construct($newsId, $title, $createDate, $modifyDate, $content, $image) {
            $this->newsId = $newsId;
            $this->title = $title;
            $this->createDate = $createDate;
            $this->modifyDate = $modifyDate;
            $this->content = $content;
            $this->image = $image;
        }

        public static function loadNews($option) {
            $db = 'Database'::getInstance();
            $query = "";
            if($option == 'M') {
                $query = "SELECT * FROM WEB_DATABASE.NEWS";
            } else {
                $query = "SELECT * FROM WEB_DATABASE.NEWS WHERE public = '1'";
            }
            $newsList = mysqli_query($db, $query);
            $row = mysqli_fetch_all($newsList, MYSQLI_ASSOC);
            return $row;
        }

        public static function loadNew($id, $option) {
            $db = 'Database'::getInstance();
            $query = "";
            if($option == 'M') {
                $query = "SELECT * FROM WEB_DATABASE.NEWS WHERE newsId = '$id'";
            } else {
                $query = "SELECT * FROM WEB_DATABASE.NEWS WHERE newsId = '$id' AND public = '1'";
            }
            $news = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($news);
            return $row;
        }

        public static function uploadNews(
            $option,
            $newsId, $title, $createDate, $modifyDate, $content, $image, $public 
        ) {
            $db = 'Database'::getInstance();
            $query = "";
            if($option == 'C') {
                $query = "INSERT INTO WEB_DATABASE.NEWS (title, createDate, modifyDate, content, image, public)
                        VALUES ('$title', '$createDate', '$modifyDate', '$content', '$image', '$public')";
            } else {
                $query =   "UPDATE WEB_DATABASE.NEWS
                            SET title = '$title', modifyDate = '$modifyDate', content = '$content', image = '$image', public ='$public'
                            WHERE newsId = '$newsId';";
            }
            $result = mysqli_query($db, $query);
            return $result;
        }
    }
?>
