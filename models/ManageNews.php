<?php    
    namespace Models;

    class ManageNews {
        public $managerId;
        public $newsId;

        public function __construct($managerId, $newsId) {
            $this->managerId = $managerId;
            $this->newsId = $newsId;
        }
    }
?>
