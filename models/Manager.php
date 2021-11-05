<?php    
    namespace Models;

    class Manager {
        public $managerId;
        public $setDate;

        public function __construct($managerId, $setDate) {
            $this->managerId = $managerId;
            $this->setDate = $setDate;
        }
    }
?>
