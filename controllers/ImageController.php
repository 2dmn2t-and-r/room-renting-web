<?php 
    namespace Controllers;
    require_once realpath(__DIR__ . '/../vendor/autoload.php');
    use ImageKit\ImageKit;

    class ImageController {
        public function getAuthenEndPoint() {
            $public_key = getenv("IMAGEKIT_PUBLIC");
            $your_private_key = getenv("IMAGEKIT_PRIVATE");
            $url_end_point = getenv("IMAGEKIT_URL_ENDPOINT");
            // $sample_file_path = "/sample.jpg";
            $imageKit = new ImageKit(
                $public_key,
                $your_private_key,
                $url_end_point
            );
            $authenticationParameters = $imageKit->getAuthenticationParameters();
            echo json_encode($authenticationParameters);
        }
    }
?>