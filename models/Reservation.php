<?php    
    namespace Models;

    class Reservation {
        public $resId;
        public $bookDate;
        public $useDate;
        public $startTime;
        public $endTime;
        public $totalPrice;
        public $status;
        public $roomId;
        public $userId;

        public function __construct($resId, $bookDate, $useDate, $startTime, $endTime, $totalPrice, $status, $roomId, $userId) {
            $this->resId = $resId;
            $this->bookDate = $bookDate;
            $this->useDate = $useDate;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->totalPrice = $totalPrice;
            $this->status = $status;
            $this->roomId = $roomId;
            $this->userId = $userId;
        }
    }
?>
