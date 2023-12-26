<?php

    require('../inc/essentials.php');
    require('../inc/db-config.php');
    adminLogin();


   
    if(isset($_POST['add_vehicle']))
    {
        $features = filteration((json_decode($_POST['features'])));

        $frm_data = filteration($_POST);
        $flag = 0;

        $q1 = "INSERT INTO `vehicles`(`name`, `space`, `price`, `quantity`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['space'], $frm_data['price'], $frm_data['quantity']];

        if(insert($q1, $values, 'ssii')){
            $flag = 1;
        }

        $vehicle_sr_no = mysqli_insert_id($con);

        $q2 = "INSERT INTO `vehicles_features`(`vehicle_sr_no`, `features_sr_no`) VALUES (?,?)";

        if($stmt = mysqli_prepare($con, $q2))
        {
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $vehicle_sr_no, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag = 0;
            die('Query cannot be prepared - Insert');
        }

        if($flag){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['get_all_vehicles']))
    {
        $res = select("SELECT * FROM `vehicles` WHERE `removed`=?",[0],'i');
        $i=1;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['status']==1){
                $status = "<button onclick='toggleStatus($row[sr_no],0)' class='btn btn-sm btn-dark shadow-none'>Active</button>";
            }
            else{
                $status = "<button onclick='toggleStatus($row[sr_no],1)' class='btn btn-sm btn-warning shadow-none'>Inactive</button>";
            }


            $data.="
                <tr class='align-middle'>
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>$row[space]</td>
                    <td>$row[price] PKR</td>
                    <td>$row[quantity]</td>
                    <td>$status</td>
                    <td>
                        <button type='button' onclick='edit_vehicle($row[sr_no])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-veh'>
                            <i class='bi bi-pencil-square'></i>
                        </button>
                        <button type='button' onclick=\"vehicle_images($row[sr_no],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#veh-image'>
                            <i class='bi bi-images'></i>
                        </button>
                        <button type='button' onclick='remove_vehicle($row[sr_no])' class='btn btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i>
                        </button>
                    </td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }

    if(isset($_POST['get_vehicle']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `vehicles` WHERE `sr_no`=?",[$frm_data['get_vehicle']],'i');
        $res2 = select("SELECT * FROM `vehicles_features` WHERE `vehicle_sr_no`=?",[$frm_data['get_vehicle']],'i');

        $roomdata = mysqli_fetch_assoc($res1);
        $features = [];

        if(mysqli_num_rows($res2)>0)
        {
            while($row = mysqli_fetch_assoc($res2)){
                array_push($features, $row['features_sr_no']);
            }
        }

        $data = ["roomdata" => $roomdata, "features" => $features];

        $data = json_encode($data);
        
        echo $data;
    }

    if(isset($_POST['edit_vehicle']))
    {
        $features = filteration(json_decode($_POST['features']));
 
        $frm_data = filteration($_POST);
        $flag = 0;

        $q1 = "UPDATE `vehicles` SET `name`=?, `space`=?, `price`=?, `quantity`=? WHERE `sr_no`=?";
        $values = [$frm_data['name'], $frm_data['space'], $frm_data['price'], $frm_data['quantity'], $frm_data['vehicle_sr_no']];
        
        if(update($q1, $values, 'ssiii')){
            $flag = 1;
        }

        $del_q = "DELETE FROM `vehicles_features` WHERE `vehicle_sr_no`=?";
        $val = [$frm_data['vehicle_sr_no']];
        $del_features = delete($del_q, $val ,'i');

        if(!($del_features)){
            $flag = 0;
        }

        $q2 = "INSERT INTO `vehicles_features`(`vehicle_sr_no`,`features_sr_no`) VALUES (?,?)";

        if($stmt = mysqli_prepare($con, $q2))
        {
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['vehicle_sr_no'], $f);
                mysqli_stmt_execute($stmt);
            }
            $flag = 1;
            mysqli_stmt_close($stmt);
        }
        else{
            $flag = 0;
            die('Query cannot be prepared - Insert');
        }

        if($flag){
            echo 1;
        }
        else{
            echo 0;
        }

    }


    if(isset($_POST['toggleStatus']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `vehicles` SET `status`=? WHERE `sr_no`=?";
        $v = [$frm_data['value'], $frm_data['toggleStatus']];

        if(update($q, $v, 'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
    }


    if(isset($_POST['add_image']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'],VEHICLES_FOLDER);

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
            $q = "INSERT INTO `vehicle_images`(`vehicle_sr_no`, `image`) VALUES (?,?)";
            $values = [$frm_data['vehicle_sr_no'],$img_r];
            $res = insert($q, $values, 'ss');
            echo $res;
        }
    }
    
    if(isset($_POST['get_vehicle_images']))
    {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `vehicle_images` WHERE `vehicle_sr_no`=?",[$frm_data['get_vehicle_images']],'i');

        $path = VEHICLES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb']==1){
                $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[vehicle_sr_no])' class='btn btn-secondary shadow-none'>
                                <i class='bi bi-check-lg'></i>
                            </button>";
            }

            echo <<<data
                <tr class='align-middle'>
                    <td><img src='$path$row[image]' class='img-fluid'></td>
                    <td>$thumb_btn</td>
                    <td>
                        <button onclick='rem_image($row[sr_no],$row[vehicle_sr_no])' class='btn btn-danger shadow-none'>
                            <i class='bi bi-trash'></i>
                        </button>
                    </td>
                </tr>
            data;
        }
    }

    if(isset($_POST['rem_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'], $frm_data['vehicle_sr_no']];

        $pre_q = "SELECT * FROM `vehicle_images` WHERE `sr_no`=? AND `vehicle_sr_no`=?";
        $res = select($pre_q,$values,'ii');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'], VEHICLES_FOLDER)){
            $q = "DELETE FROM `vehicle_images` WHERE `sr_no`=? AND `vehicle_sr_no`=?";
            $res = delete($q,$values,'ii');
            echo $res;
        }
        else{
            echo 0;
        }

    }

    if(isset($_POST['thumb_image']))
    {
        $frm_data = filteration($_POST);

        $pre_q = "UPDATE `vehicle_images` SET `thumb`=? WHERE `vehicle_sr_no`=?";
        $pre_v = [0,$frm_data['vehicle_sr_no']];
        $pre_res = update($pre_q,$pre_v,'ii');
        
        $q = "UPDATE `vehicle_images` SET `thumb`=? WHERE `sr_no`=? AND `vehicle_sr_no`=?";
        $values = [1,$frm_data['image_id'],$frm_data['vehicle_sr_no']];
        $res = update($q,$values,'iii');
        
        echo $res;
    }

    if(isset($_POST['remove_vehicle']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `vehicle_images` WHERE `vehicle_sr_no`=?",[$frm_data['vehicle_sr_no']],'i');
        
        while($row = mysqli_fetch_assoc($res1)){
            deleteImage($row['image'],VEHICLES_FOLDER);
        }

        $res2 = delete("DELETE FROM `vehicle_images` WHERE `vehicle_sr_no`=?",[$frm_data['vehicle_sr_no']],'i');
        $res3 = delete("DELETE FROM `vehicles_features` WHERE `vehicle_sr_no`=?",[$frm_data['vehicle_sr_no']],'i');
        $res4 = update("UPDATE `vehicles` SET `removed`=? WHERE `sr_no`=?",[1,$frm_data['vehicle_sr_no']],'ii');

        if($res2 || $res3 || $res4){
            echo 1;
        }
        else{
            echo 0;
        }
    }

?>