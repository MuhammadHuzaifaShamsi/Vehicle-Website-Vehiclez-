<?php
    require('../admin/inc/essentials.php');
    require('../admin/inc/db-config.php');

    if(isset($_POST['info_form']))
    {
        $frm_data = filteration($_POST);
        session_start();

        
        $u_exist = select("SELECT * FROM `user_cred` WHERE `pn`=? AND `sr_no`!=? LIMIT 1",
            [$frm_data['pn'],$_SESSION['uid']],'ii');

        if(mysqli_num_rows($u_exist)!=0){
            echo 'phone_already';
            exit;
        }

        $query = "UPDATE `user_cred` SET `name`=?, `pn`=?, `dob`=?, `cnic`=?, `address`=? WHERE `sr_no`=? LIMIT 1";
        $values = [$frm_data['name'], $frm_data['pn'], $frm_data['dob'], $frm_data['cnic'], $frm_data['address'], 
            $_SESSION['uid']];
        
        if(update($query,$values,'sssssi')){
            $_SESSION['uname'] = $frm_data['name'];
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['profile_form']))
    {
        session_start();

        $img = uploadUserImg($_FILES['profile']);

        if($img == 'inv_img'){
            echo 'inv_img';
            exit;
        }
        else if($img == 'upd_failed'){
            echo 'upd_failed';
            exit;
        }
        else{
            echo 1;
        }

        
        // Fetching old img and deleting it... 
        $u_exist = select("SELECT `profile` FROM `user_cred` WHERE `sr_no`=? LIMIT 1",
            [$_SESSION['uid']],"s");
        $u_fetch = mysqli_fetch_assoc($u_exist);

        deleteImage($u_fetch['profile'],USERS_FOLDER);


        $query = "UPDATE `user_cred` SET `profile`=? WHERE `sr_no`=? LIMIT 1";

        $values = [$img ,$_SESSION['uid']];
        
        if(update($query,$values,'ss')){
            $_SESSION['upic'] = $img;
            echo 1;
        }
        else{
            echo 0;
        }
    }
 
    if(isset($_POST['pass_form']))
    {
        $frm_data = filteration($_POST);
        session_start();

        if($frm_data['pass'] != $frm_data['cpass']){
            echo 'mismatch';
            exit;
        }

        $enc_pass = password_hash($frm_data['pass'],PASSWORD_BCRYPT);
        $enc_cpass = password_hash($frm_data['cpass'],PASSWORD_BCRYPT);

        $query = "UPDATE `user_cred` SET `pass`=?, `cpass`=? WHERE `sr_no`=?";

        $values = [$enc_pass,$enc_cpass, $_SESSION['uid']];
        
        if(update($query,$values,'ssi')){
            echo 1;
        }
        else{
            echo 0;
        }
    }
?>