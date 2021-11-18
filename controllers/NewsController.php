<?php
    namespace Controllers;
    require_once('models/News.php');

    class NewsController {
        public function loadNewsList() {
            $News = 'Models\\News';
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.NEWS";
            $newsList = mysqli_query($db, $query);
            $row = mysqli_fetch_all($newsList, MYSQLI_ASSOC);
            
            echo json_encode(['news'=>$row, 'status'=>200]);
        }

        public function loadNews($id) {
            $News = 'Models\\News';
            $db = 'Database'::getInstance();

            $query = "SELECT * FROM WEB_DATABASE.NEWS WHERE newsId = '$id'";
            $news = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($news);
            if(!$row) {
                echo json_encode(['msg' => 'Invalid news ID.', 'status'=>401]); 
                return;
            }
            echo json_encode(['news'=>$row, 'status'=>200]);
        }

        public function uploadNews() {
            $News = 'Models\\News';

            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $type = $authorization['type'];
            if($type != 'M') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }

            $db = 'Database'::getInstance();

            $news = json_decode(file_get_contents('php://input'), true);
            $title = $news['title'];
            $modifyDate = $news['modifyDate'];
            $content = $news['content'];
            $image = $news['image'];
            $public = $news['public'];

            if (array_key_exists('newsId', $news)) {
                $newsId = $news['newsId'];
                $query =   "UPDATE WEB_DATABASE.NEWS
                            SET title = '$title', modifyDate = '$modifyDate', content = '$content', image = '$image', public ='$public'
                            WHERE newsId = '$newsId';";
            }
            else {
                $createDate = $news['createDate'];
                $query =   "INSERT INTO WEB_DATABASE.NEWS (title, createDate, modifyDate, content, image, public)
                            VALUES ('$title', '$createDate', '$modifyDate', '$content', '$image', '$public')";
            }
            
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]); 
        }

        public function loadNewsComments($id) {
            $NewsComment = 'Models\\NewsComment';
            $db = 'Database'::getInstance();

            $query =   "SELECT commentId, date, content, newsId, userId, username, avatar 
                        FROM WEB_DATABASE.NEWS_COMMENT NATURAL JOIN WEB_DATABASE.USER 
                        WHERE newsId = '$id'";
            $newscomments = mysqli_query($db, $query);
            $row = mysqli_fetch_all($newscomments, MYSQLI_ASSOC);
            echo json_encode(['news_comments'=>$row, 'status'=>200]);
        }

        public function uploadNewsComment() {
            $NewsComment = 'Models\\NewsComment';
            $VerifyAccount = 'Middlewares\\VerifyAccount';

            $authorization = $VerifyAccount::checkAuthState();
            
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $comment = json_decode(file_get_contents('php://input'), true);
            
            $date = $comment["date"]; 
            $content = $comment["content"];
            $newsId = $comment["newsId"]; 
            $userId = $authorization['userId'];

            $db = 'Database'::getInstance();
            
            if (array_key_exists('commentId', $comment)) {
                $commentId = $comment["commentId"]; 
                $query =   "UPDATE WEB_DATABASE.NEWS_COMMENT
                            SET date = '$date', content = '$content'
                            WHERE commentId = '$commentId' AND newsId = '$newsId' AND userId = '$userId'";
            }
            else {
                $query =   "INSERT INTO WEB_DATABASE.NEWS_COMMENT (date, content, newsId, userId)
                            VALUES ('$date', '$content', '$newsId', '$userId')";
            }

            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }

        public function deleteNewsComment() {
            $NewsComment = 'Models\\NewsComment';
            $VerifyAccount = 'Middlewares\\VerifyAccount';

            $authorization = $VerifyAccount::checkAuthState();
            
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }

            $comment = json_decode(file_get_contents('php://input'), true);
            
            $commentId = $comment["commentId"];

            $userId = $authorization['userId'];
            $type = $authorization['type'];
            if($type == 'M') {
                $query =   "DELETE FROM WEB_DATABASE.NEWS_COMMENT
                            WHERE commentId = '$commentId'";
            }
            else {
                $query =   "DELETE FROM WEB_DATABASE.NEWS_COMMENT
                            WHERE commentId = '$commentId' AND userId = '$userId'";
            }
            $db = 'Database'::getInstance();
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>