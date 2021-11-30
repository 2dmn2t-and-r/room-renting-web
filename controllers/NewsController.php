<?php
    namespace Controllers;

    require_once('models/News.php');
    require_once('models/NewsComment.php');

    class NewsController {
        public function loadNewsList() {
            $News = 'Models\\News';
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            $row = [];
            if($authorization && $authorization['type'] == 'M') {
                $row = $News::loadNews('M');
            } else {
                $row = $News::loadNews('');
            }
            
            echo json_encode(['news'=>$row, 'status'=>200]);
        }

        public function loadNews($id) {
            $News = 'Models\\News';

            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if($authorization && $authorization['type'] == 'M') {
                $row = $News::loadNew($id, 'M');
            } else {
                $row = $News::loadNew($id, '');
            }
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

            $news = json_decode(file_get_contents('php://input'), true);
            $title = $news['title'];
            $modifyDate = $news['modifyDate'];
            $content = $news['content'];
            $image = $news['image'];
            $public = $news['public'];

            if (array_key_exists('newsId', $news)) {
                $newsId = $news['newsId'];
                $result = $News::uploadNews('', $newsId, $title, $modifyDate, $modifyDate, $content, $image, $public);
            }
            else {
                $createDate = $news['createDate'];
                $result = $News::uploadNews('C', '', $title, $createDate, $modifyDate, $content, $image, $public);
            }
            echo json_encode(['result' => $result, 'status'=>200]); 
        }

        public function removeNews($newsId) {
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

            $results = $News::removeNews($newsId);
            echo json_encode(['results'=>$results, 'status'=>200]);
        }

        public function loadNewsComments($id) {
            $NewsComment = 'Models\\NewsComment';
            $row = $NewsComment::loadNewsComments($id);
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
            
            if (array_key_exists('commentId', $comment)) {
                $commentId = $comment["commentId"]; 
                $result = $NewsComment::uploadNewsComment('', $commentId, $date, $content, $newsId, $userId);
            }
            else {
                $result = $NewsComment::uploadNewsComment('C', '', $date, $content, $newsId, $userId);
            }

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
                $result = $NewsComment::deleteNewsComment('M', $commentId, $userId);
            }
            else {
                $result = $NewsComment::deleteNewsComment('', $commentId, $userId);
            }
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>