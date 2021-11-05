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
    }
?>
