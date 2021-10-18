<?php    
    class Database {
        private static $instance = NULL;
        private static $servername = "localhost";
        private static $username = "root";
        private static $password = "";
        private static $dbname = "web_database";  

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = mysqli_connect(self::$servername, self::$username, self::$password, self::$dbname);
            }
            return self::$instance;
        }
    }
?>