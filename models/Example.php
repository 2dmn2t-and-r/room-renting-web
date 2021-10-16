<?php    
    namespace Models;

    class Example {
        public $userId;
        public $username;
        public $sex;
        public $birthday;
        public $phone;
        public $address;
        public $email;
        public $type;

        public function __construct($userId, $username, $sex, $birthday, $phone, $address, $email, $type) {
            $this->userId = $userId;
            $this->username = $username;
            $this->sex = $sex;
            $this->birthday = $birthday;
            $this->phone = $phone;
            $this->address = $address;
            $this->email = $email;
            $this->type = $type;
        }
    }
?>