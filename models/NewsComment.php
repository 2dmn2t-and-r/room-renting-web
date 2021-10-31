<?php    
    namespace Models;

    use DateTime;

    class NewsComment {
        public int $commentId;
        public int $newId;
        public string $ownerName;
        public string $ownerId;
        public string $ownerImage;
        public string $content;
        public DateTime $date;

        public function __construct(
            int $commentId,
            int $roomId,
            string $ownerName,
            string $ownerId,
            string $ownerImage,
            string $content,
            DateTime $date
        ) {
            $this->commentId = $commentId;
            $this->roomId = $roomId;
            $this->ownerName = $ownerName;
            $this->ownerId = $ownerId;
            $this->ownerImage = $ownerImage;
            $this->content = $content;
            $this->date = $date; 
        }
    }
?>