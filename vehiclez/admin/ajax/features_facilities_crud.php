<?php

    require('../inc/essentials.php');
    require('../inc/db-config.php');
    adminLogin();


    // FEATURES ....
    if(isset($_POST['add_feature']))
    {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `feature`(`name`) VALUES (?)"; 
        $values = [$frm_data['name']];
        $res = insert($q, $values, 's');
        echo $res;
    }

    if(isset($_POST['get_features']))
    {
        $res = selectAll('feature');
        $i=1;
        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr>
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>
                        <button type="button" onclick="rem_feature($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                        </button>  
                    </td>
                    
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_feature']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_feature']];

        $check_q = select('SELECT * FROM `vehicles_features` WHERE `features_sr_no`=?',[$frm_data['rem_feature']],'i');
        
        if(mysqli_num_rows($check_q)==0){
            $q = "DELETE FROM `feature` WHERE `sr_no`=?";
            $res = delete($q,$values,'i');
            echo $res;
        }
        else{
            echo 'vehicle_added';
        }
    }


    // FACILITIES ....
    if(isset($_POST['add_facility']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadSVGImage($_FILES['icon'],FACILITIES_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
            $values = [$img_r,$frm_data['name'],$frm_data['des']];
            $res = insert($q, $values, 'sss');
            echo $res;
        }
    }

    if(isset($_POST['get_facilities']))
    {
        $res = selectAll('facilities');
        $path = FACILITIES_IMG_PATH;
        $i=1;


        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td><img src="$path$row[icon]" width="30px"></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="rem_facility($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                        </button>  
                    </td>
                    
                </tr>
            data;
            $i++;
        }
    }
    
    if(isset($_POST['rem_facility']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_facility']];
        
        $pre_q = "SELECT * FROM `facilities` WHERE `sr_no`=?";
        $res = select($pre_q,$values,'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['icon'], FACILITIES_FOLDER)){
            $q = "DELETE FROM `facilities` WHERE `sr_no`=?";
            $res = delete($q,$values,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }
?>