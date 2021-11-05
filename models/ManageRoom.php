<?php    
    namespace Models;

    class ManageRoom {
        public $managerId;
        public $roomId;

        public function __construct($managerId, $roomId) {
            $this->managerId = $managerId;
            $this->roomId = $roomId;
        }
    }
?>
