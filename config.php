<?php
    require_once realpath(__DIR__ . "/vendor/autoload.php");

    use Dotenv\Dotenv ;
    $dotenv = Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();
    
    class Database {
        private static $instance = NULL;
        public static function getInstance() {
            $servername = getenv("MYSQL_SERVERNAME");
            $username = getenv("MYSQL_USERNAME");
            $password = getenv("MYSQL_PASSWORD");
            $dbname = getenv("MYSQL_DBNAME");
            
            if(!isset(self::$instance)) {
                self::$instance = mysqli_connect($servername, $username, $password, $dbname);
            }
            return self::$instance;
        }
    }
?>