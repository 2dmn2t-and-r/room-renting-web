<?php    
    namespace Models;

    class Room {
        public $roomId;
        public $roomName;
        public $type;
        public $floor;
        public $price;
        public $status;
        public $openTime;
        public $closeTime;
        public $address;
        public $description;
        public $image;

        public function __construct($roomId, $roomName, $type, $floor, $price, $status, $openTime, $closeTime, $address, $description, $image) {
            $this->roomId = $roomId;
            $this->roomName = $roomName;
            $this->type = $type;
            $this->floor = $floor;
            $this->price = $price;
            $this->status = $status;
            $this->openTime = $openTime;
            $this->closeTime = $closeTime;
            $this->address = $address;
            $this->description = $description;
            $this->image = $image;
        }
    }
?>
