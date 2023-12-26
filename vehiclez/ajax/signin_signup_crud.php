<?php
    require('../admin/inc/essentials.php');
    require('../admin/inc/db-config.php');

    if(isset($_POST['register']))
    {
        $data = filteration($_POST);

        // Password and Confirm Password
        if($data['pass'] != $data['cpass']){
            echo 'pass_mismatch';
            exit;
        }

        // Check User already exists or not...
        $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `pn`=? LIMIT 1",[$data['email'],
            $data['pn']],'si');

        if(mysqli_num_rows($u_exist)!=0){
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
            exit;
        }

        // Upload User Image to Server
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
            echo 'img_uploaded';
        }

        

        $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
        $enc_cpass = password_hash($data['cpass'],PASSWORD_BCRYPT);

        $q = "INSERT INTO `user_cred`(`name`, `email`, `cnic`, `dob`, `pn`, `profile`, `address`, `pass`,`cpass`)
            VALUES (?,?,?,?,?,?,?,?,?)";
        $v = [$data['name'],$data['email'],$data['cnic'],$data['dob'],$data['pn'], $img, $data['address'],$enc_pass,$enc_cpass];

        if(insert($q,$v,'ssisissss')){
            echo 1;
        }
        else{
            echo 'ins_failed';
        }
    }

    if(isset($_POST['login']))
    {
        $data = filteration($_POST);


        $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `pn`=? LIMIT 1",[$data['email_pn'],
            $data['email_pn']],'ss');

        if(mysqli_num_rows($u_exist)==0){
            echo 'inv_email_pn';
        }
        else{
            $u_fetch = mysqli_fetch_assoc($u_exist);
            if($u_fetch['status']==0){
                echo 'inactive';
            }
            else{
                if(!password_verify($data['pass'],$u_fetch['pass'])){
                    echo 'invalid_pass';
                }
                else{
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['uid'] = $u_fetch['sr_no'];
                    $_SESSION['uname'] = $u_fetch['name'];
                    $_SESSION['upic'] = $u_fetch['profile'];
                    $_SESSION['upn'] = $u_fetch['pn'];
                    echo 1;
                }
            }
        }
    }


?>