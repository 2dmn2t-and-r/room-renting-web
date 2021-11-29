<?php
    namespace Models;

    class Information {
        public $title1;
        public $content1;
        public $image1;
        public $title2;
        public $content2;
        public $image2;
        public $address;
        public $email;
        public $phone;
        public $facebook;
        public $twitter;
        public $instagram;
        public $tiktok;

        public static function loadInfo() {
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.INFOMATION ORDER BY infoId DESC LIMIT 1";
            $info = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($info);
            return $row;
        }

        public static function uploadInfo($title1, $content1, $image1, $title2, $content2, $image2, $address, $email, $phone, $facebook, $twitter, $instagram, $tiktok) {
            $db = 'Database'::getInstance();
            $query =   "INSERT INTO WEB_DATABASE.INFOMATION (title1, content1, image1, title2, content2, image2, address, email, phone, facebook, twitter, instagram, tiktok)
                        VALUES ('$title1', '$content1', '$image1', '$title2', '$content2', '$image2', '$address', '$email', '$phone', '$facebook', '$twitter', '$instagram', '$tiktok')";
            $result = mysqli_query($db, $query);
            return $result;
        }
    }
?>