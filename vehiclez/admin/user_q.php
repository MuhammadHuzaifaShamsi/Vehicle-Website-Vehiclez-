<?php
    require('inc/essentials.php');
    require('inc/db-config.php');
    adminLogin();

    if(isset($_GET['seen'])){
        $frm_data = filteration($_GET);

        if($frm_data['seen']=='all'){
            $q = "UPDATE `user_q` SET `seen`=?";
            $values = [1];
            if(update($q,$values,'i')){
                alert('success','Marked all as Read!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
        else{
            $q = "UPDATE `user_q` SET `seen`=? WHERE `sr_no`=?";
            $values = [1,$frm_data['seen']];
            if(update($q,$values,'ii')){
                alert('success','Marked as Read!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
    }

    if(isset($_GET['del'])){
        $frm_data = filteration($_GET);

        if($frm_data['del']=='all'){
            $q = "DELETE FROM `user_q`";
            if(mysqli_query($con,$q)){
                alert('success','All Messages Deleted!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
        else{
            $q = "DELETE FROM `user_q` WHERE `sr_no`=?";
            $values = [$frm_data['del']];
            if(update($q,$values,'i')){
                alert('success','Message Deleted!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>Admin Panel - User Queries | <?php echo $settings_r['site_title'] ?></title>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php');  ?>   

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User Queries</h3>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                    
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-sm btn-dark shadow-none rounded-pill">
                                <i class="bi bi-check-all"></i> Mark all as Read</a>
                            <a href="?del=all" class="btn btn-sm btn-danger shadow-none rounded-pill">
                                <i class="bi bi-trash"></i> Delete all Messages</a>
                        </div>

                        <div class="table-responsive-md" style="height: 400px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="table-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM `user_q` ORDER BY `sr_no` DESC";
                                        $data = mysqli_query($con, $q);
                                        $i=1;

                                        while($row = mysqli_fetch_assoc($data))
                                        {
                                            $seen = '';
                                            if($row['seen']!=1){
                                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm btn-primary rounded-pill'>Mark as Read</a> <br>";
                                            }
                                            $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm btn-danger rounded-pill mt-2'>Delete</a>";
                                            echo <<<data
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[name]</td>
                                                <td>$row[email]</td>
                                                <td>$row[subject]</td>
                                                <td>$row[message]</td>
                                                <td>$row[date]</td>
                                                <td>$seen</td>
                                            </tr>
                                            data;
                                            $i++;
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

             
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>

</body>
</html>