<?php    
    namespace Models;

    class News {
        public $newsId;
        public $title;
        public $createDate;
        public $modifyDate;
        public $content;
        public $image;

        public function __construct($newsId, $title, $createDate, $modifyDate, $content, $image) {
            $this->newsId = $newsId;
            $this->title = $title;
            $this->createDate = $createDate;
            $this->modifyDate = $modifyDate;
            $this->content = $content;
            $this->image = $image;
        }
    }
?>
