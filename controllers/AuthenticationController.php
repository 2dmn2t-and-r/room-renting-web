<?php
    namespace Controllers;
    require_once('models/User.php');
    require_once('jwtGeneration.php');
    require_once('middlewares/VerifyAccount.php');

    class AuthenticationController {
        public function getUser() {
            $headers = apache_request_headers();
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401, 'header' => $headers]);
                return;
            }
            echo json_encode(['user'=>$authorization, 'status'=>200]);
        }

        public function login() {
            $db = 'Database'::getInstance();
            
            $User = 'Models\\User';

            $user = json_decode(file_get_contents('php://input'), true);

            $email = $user['email'];
            $password = $user['password'];

            $query = "SELECT usr.*  
                        FROM user as usr
                        WHERE `email`='$email' AND `password`='$password'";
            $account = mysqli_query($db, $query);
            
            $row = mysqli_fetch_assoc($account);
            
            if(!$row) {
                echo json_encode(['msg' => 'Incorrect email or password.', 'status'=>401]); 
                return;
            }
            
            $headers = array('alg'=>'HS256', 'typ'=>'JWT');
            $payload = array('id'=>$row['userId'], 'email'=>$row['email'], 'password'=>$row['password'], 'type'=>$row['type'], 'exp'=>(time()+60*60*12));
            $token = generateJwt($headers, $payload);

            echo json_encode(['user'=>$row, 'token'=>$token, 'status'=>200]);
        }

        public function register() {
            
            $db = 'Database'::getInstance();
            
            $User = 'Models\\User';

            $user = json_decode(file_get_contents('php://input'), true);
            
            $email = $user['email'];
            
            $query = "SELECT email FROM user WHERE email='$email'";
            $check_email = mysqli_query($db, $query);
            
            if(mysqli_fetch_row($check_email)) {
                echo json_encode(['msg' => 'This email has been already existed.', 'status'=>401]); 
                return;
            }
            
            $username = $user['username'];
            $password = $user['password'];
            $sex = $user['sex'];
            $birthday = $user['birthday'];
            $phone = $user['phone'];
            $address = $user['address'];
            $type = 'C';
            $avatar = $user['avatar'];
            $query = "INSERT INTO user(`username`, `password`, `sex`, `birthday`, `phone`, `address`, `email`, `type`, `avatar`) VALUES ('$username', '$password', '$sex', '$birthday', '$phone', '$address', '$email', '$type', '$avatar')";
            $result = mysqli_query($db, $query);
            if($result)
                echo json_encode(['result' => $result,'status'=>200]);
            else 
                echo json_encode(['result' => $result,'status'=>500]);
        }

        public function loadProfile($id) {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $type = $authorization['type'];
            if($type == 'C') {
                echo json_encode(['msg'=>'Permission denied.', 'status'=>401]);
                return;
            }

            $db = 'Database'::getInstance();
            $User = 'Models\\User';

            $query = "SELECT usr.username, usr.sex, usr.birthday, usr.phone, usr.address, usr.avatar
                        FROM user as usr
                        WHERE userId='$id'";
            $user = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($user);
            if(!$row) {
                echo json_encode(['msg' => 'Incorrect email or password.', 'status'=>401]); 
                return;
            }
            echo json_encode(['user'=>$row, 'status'=>200]);
        }

        public function uploadProfile() {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $type = $authorization['type'];

            $db = 'Database'::getInstance();

            $User = 'Models\\User';
            
            $user = json_decode(file_get_contents('php://input'), true);
            
            $username = $user['username'];
            $sex = $user['sex'];
            $birthday = $user['birthday'];
            $phone = $user['phone'];
            $address = $user['address'];
            $avatar = $user['avatar'];
            $query = "UPDATE user  
                        SET `username`='$username', `sex`='$sex', `birthday`='$birthday', `phone`='$phone', `address`='$address', `avatar`='$avatar'
                        WHERE userId='$userId'";
            $result = mysqli_query($db, $query);
            if($result)
                echo json_encode(['result' => $result, 'status'=>200]);    
            else           
                echo json_encode(['result' => $result, 'status'=>500]);
        }

        public function changePassword() {
            $VerifyAccount = 'Middlewares\\VerifyAccount';
            $authorization = $VerifyAccount::checkAuthState();
            if(!$authorization) {
                echo json_encode(['msg'=>'Invalid account.', 'status'=>401]);
                return;
            }
            $userId = $authorization['userId'];
            $type = $authorization['type'];
            $userPassword = $authorization['password'];

            $db = 'Database'::getInstance();
            $User = 'Models\\User';
            
            $request = json_decode(file_get_contents('php://input'), true);

            $oldPassword = $request['oldPassword'];
            $newPassword = $request['newPassword'];

            if($oldPassword == $userPassword) {       
                $query = "UPDATE user  
                        SET `password`='$newPassword'
                        WHERE userId='$userId'";
                $update = mysqli_query($db, $query);
                if($update)
                    echo json_encode(['result'=>$update, 'status'=>200]);
                else 
                    echo json_encode(['result'=>$update, 'status'=>500]);
            } else 
                echo json_encode(['status'=>500]);        
        }
    }
?>