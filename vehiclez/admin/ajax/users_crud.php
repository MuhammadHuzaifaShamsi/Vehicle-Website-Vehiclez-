<?php

    require('../inc/essentials.php');
    require('../inc/db-config.php');
    adminLogin();


    if(isset($_POST['get_users']))
    {
        $res = selectAll('user_cred');
        $i=1;
        $path = USERS_IMG_PATH;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            $status = "<button onclick='toggleStatus($row[sr_no],0)' class='btn btn-sm btn-dark shadow-none'>Active</button>";

            if($row['status']==0){
                $status = "<button onclick='toggleStatus($row[sr_no],1)' class='btn btn-sm btn-danger shadow-none'>Inactive</button>";
            }

            $date = date("d-m-Y",strtotime($row['date_time']));

            $data.="
                <tr class='align-middle'>
                    <td>$i</td>
                    <td>
                        <img src='$path$row[profile]' width='55px'> <br>
                        $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[pn]</td>
                    <td>$row[address]</td>
                    <td>$row[dob]</td>
                    <td>$status</td>
                    <td>$date</td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }

    if(isset($_POST['toggleStatus']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `user_cred` SET `status`=? WHERE `sr_no`=?";
        $v = [$frm_data['value'], $frm_data['toggleStatus']];

        if(update($q, $v, 'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['search_user']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";
        
        $res = select($query,["%$frm_data[name]%"],'s');

        $i=1;
        $path = USERS_IMG_PATH;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            $status = "<button onclick='toggleStatus($row[sr_no],0)' class='btn btn-sm btn-dark shadow-none'>Active</button>";

            if($row['status']==0){
                $status = "<button onclick='toggleStatus($row[sr_no],1)' class='btn btn-sm btn-danger shadow-none'>Inactive</button>";
            }

            $date = date("d-m-Y",strtotime($row['date_time']));

            $data.="
                <tr class='align-middle'>
                    <td>$i</td>
                    <td>
                        <img src='$path$row[profile]' width='55px'> <br>
                        $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[pn]</td>
                    <td>$row[address]</td>
                    <td>$row[dob]</td>
                    <td>$status</td>
                    <td>$date</td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }


?>