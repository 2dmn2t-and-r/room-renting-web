<?php    
    namespace Models;

    class User {
        public $userId;
        public $username;
        public $password;
        public $sex;
        public $birthday;
        public $phone;
        public $address;
        public $email;
        public $type;
        public $avatar;

        public function __construct($userId, $username, $password, $sex, $birthday, $phone, $address, $email, $type, $avatar) {
            $this->userId = $userId;
            $this->username = $username;
            $this->password = $password;
            $this->sex = $sex;
            $this->birthday = $birthday;
            $this->phone = $phone;
            $this->address = $address;
            $this->email = $email;
            $this->type = $type;
            $this->avatar = $avatar;
        }

        public static function login($email, $password) {
            $db = 'Database'::getInstance();
            $query = "SELECT usr.*  
                        FROM user as usr
                        WHERE `email`='$email' AND `password`='$password'";
            $account = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($account);
            return $row;
        }

        public static function validateRegister($email) {
            $db = 'Database'::getInstance();
            $query = "SELECT email FROM user WHERE email='$email'";
            $check_email = mysqli_query($db, $query);
            return $check_email;
        }

        public static function register($email, $username, $password, $sex, $birthday, $phone, $address, $type, $avatar) {
            $db = 'Database'::getInstance();
            $query = "INSERT INTO user(`username`, `password`, `sex`, `birthday`, `phone`, `address`, `email`, `type`, `avatar`) VALUES ('$username', '$password', '$sex', '$birthday', '$phone', '$address', '$email', '$type', '$avatar')";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function getProfile($id) {
            $db = 'Database'::getInstance();
            $query = "SELECT usr.username, usr.sex, usr.birthday, usr.phone, usr.address, usr.avatar
                        FROM user as usr
                        WHERE userId='$id'";
            $user = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($user);
            return $row;
        }

        public static function postProfile(
            $userId,
            $username, $sex, $birthday, $phone, $address, $avatar
        ) {
            $db = 'Database'::getInstance();
            $query = "UPDATE user  
                        SET `username`='$username', `sex`='$sex', `birthday`='$birthday', `phone`='$phone', `address`='$address', `avatar`='$avatar'
                        WHERE userId='$userId'";
            $result = mysqli_query($db, $query);
            return $result;
        }

        public static function setPassword($newPassword, $userId) {
            $db = 'Database'::getInstance();
            $query = "UPDATE user  
                        SET `password`='$newPassword'
                        WHERE userId='$userId'";
            $update = mysqli_query($db, $query);
            return $update;
        }

        public static function getUser($userId) {
            $db = 'Database'::getInstance();
            $query = "SELECT usr.* FROM user as usr WHERE userId=$userId";
            $account = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($account);
            return $row;
        }
    }
?>
