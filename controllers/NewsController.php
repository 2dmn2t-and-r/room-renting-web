<?php
    namespace Controllers;
    require_once('models/News.php');

    class NewsController {
        public function loadNewsList() {
            $News = 'News\\Room';
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.NEWS";
            $newsList = mysqli_query($db, $query);
            $row = mysqli_fetch_all($newsList, MYSQLI_ASSOC);
            
            echo json_encode(['rooms'=>$row, 'status'=>200]);
        }

        public function loadNews($id) {
            $News = 'News\\Room';
            $db = 'Database'::getInstance();

            $query = "SELECT * FROM WEB_DATABASE.NEWS WHERE newsId = '$id'";
            $news = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($news);
            if(!$row) {
                echo json_encode(['msg' => 'Invalid news ID.', 'status'=>401]); 
                return;
            }
            echo json_encode(['room'=>$row, 'status'=>200]);
        }

        public function uploadNews() {
            $News = 'News\\Room';

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
            $createDate = $news['createDate'];
            $modifyDate = $news['modifyDate'];
            $content = $news['content'];
            $image = $news['image'];

            if (array_key_exists('newsId', $news)) {
                $newsId = $news['newsId'];
                $query =   "UPDATE WEB_DATABASE.NEWS
                            SET title = '$title', createDate = '$createDate', modifyDate = '$modifyDate', content = '$content', image = '$image'
                            WHERE newsId = '$newsId';";
            }
            else {
                $query =   "INSERT INTO WEB_DATABASE.NEWS (title, createDate, modifyDate, content, image)
                            VALUES ('$title', '$createDate', '$modifyDate', '$content', '$image')";
            }
            
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]); 
        }
    }
?>