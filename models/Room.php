<?php    
    namespace Models;

    class Room {
        public $roomId;
        public $roomName;
        public $type;
        public $floor;
        public $seat;
        public $price;
        public $statusRo;
        public $openTime;
        public $closeTime;
        public $address;
        public $description;
        public $image;

        public function __construct($roomId, $roomName, $type, $floor, $seat, $price, $statusRo, $openTime, $closeTime, $address, $description, $image) {
            $this->roomId = $roomId;
            $this->roomName = $roomName;
            $this->type = $type;
            $this->floor = $floor;
            $this->seat = $seat;
            $this->price = $price;
            $this->statusRo = $statusRo;
            $this->openTime = $openTime;
            $this->closeTime = $closeTime;
            $this->address = $address;
            $this->description = $description;
            $this->image = $image;
        }
    }
?>
