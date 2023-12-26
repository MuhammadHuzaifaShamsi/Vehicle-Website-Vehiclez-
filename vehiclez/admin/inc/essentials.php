<?php

    // FRONTEND PURPOSE DATA
    define('SITE_URL','http://127.0.0.1/vehiclez/');
    define('ABOUT_IMG_PATH',SITE_URL.'assets/images/about/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'assets/images/carousel/');
    define('FACILITIES_IMG_PATH',SITE_URL.'assets/images/facilities/');
    define('VEHICLES_IMG_PATH',SITE_URL.'assets/images/vehicles/');
    define('USERS_IMG_PATH',SITE_URL.'assets/images/users/');

    // BACKEND UPLOAD PROCESS REQUIRED DATA
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/Vehiclez/assets/images/');
    define('ABOUT_FOLDER','about/');
    define('CAROUSEL_FOLDER','carousel/');
    define('FACILITIES_FOLDER','facilities/');
    define('VEHICLES_FOLDER','vehicles/');
    define('USERS_FOLDER','users/');

    function alert($type,$msg)
    {
        $al_cl = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
                <div class="alert $al_cl alert-dismissible fade show custom-alert" role="alert">
                    <strong class="me-3">$msg</strong>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                alert;
    }

    function redirect($url)
    {
        echo"
            <script>
                window.location.href = '$url';
            </script>
        ";
    }

    function adminLogin()
    {
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
            echo"
            <script>
                window.location.href = 'index.php';
            </script>
        ";
        exit;
        }
    }

    function uploadImage($image,$folder)
    {
        $valid_mime = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function uploadSVGImage($image,$folder)
    {
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function deleteImage($image, $folder)
    {
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }

    function uploadUserImg($image)
    {
        $valid_mime = ['image/jpg', 'image/png', 'image/webp', 'image/jpeg'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext == 'PNG'){
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP'){
                $img = imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img = imagecreatefromjpeg($image['tmp_name']);
            }


            if(imagejpeg($img,$img_path,75)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

?>