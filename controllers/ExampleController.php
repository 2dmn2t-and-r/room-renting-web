<?php
    namespace Controllers;
    require_once('models/Example.php');    

    class ExampleController {
        public function index() {
            $example = [];
            $db = 'Database'::getInstance();
            $result = mysqli_query($db,'SELECT * FROM user');
            $Example = 'Models\\Example';
            while($row = mysqli_fetch_assoc($result)){
                $example[] = new $Example(
                            $row['userId'],
                            $row['username'],
                            $row['sex'],
                            $row['birthday'],
                            $row['phone'],
                            $row['address'],
                            $row['email'],
                            $row['type'],
                        );
            }
            echo json_encode($example);
        }

        public function data() {
            if(isset($_POST['data'])) {
                echo $_POST['data'];
            }
        }
    }
?>