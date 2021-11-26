<?php
    namespace Controllers;

    use mysqli_result;

    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class InfomationController {
        public function loadInfo() {
            $db = 'Database'::getInstance();
            $query = "SELECT * FROM WEB_DATABASE.INFOMATION ORDER BY infoId DESC LIMIT 1";
            $info = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($info);
            if(!$row) {
                echo json_encode(['msg' => 'Something wrong!.', 'status'=>401]); 
                return;
            }
            echo json_encode(['info'=>$row, 'status'=>200]);
        }

        public function uploadInfo() {
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

            $info = json_decode(file_get_contents('php://input'), true);
            $title1 = $info['title1'];
            $content1 = $info['content1'];
            $image1 = $info['image1'];
            $title2 = $info['title2'];
            $content2 = $info['content2'];
            $image2 = $info['image2'];
            $address = $info['address'];
            $email = $info['email'];
            $phone = $info['phone'];
            $facebook = $info['facebook'];
            $twitter = $info['twitter'];
            $instagram = $info['instagram'];
            $tiktok = $info['tiktok'];

            $query =   "INSERT INTO WEB_DATABASE.INFOMATION (title1, content1, image1, title2, content2, image2, address, email, phone, facebook, twitter, instagram, tiktok)
                        VALUES ('$title1', '$content1', '$image1', '$title2', '$content2', '$image2', '$address', '$email', '$phone', '$facebook', '$twitter', '$instagram', '$tiktok')";
            
            $result = mysqli_query($db, $query);
            echo json_encode(['result' => $result, 'status'=>200]);
        }
    }
?>