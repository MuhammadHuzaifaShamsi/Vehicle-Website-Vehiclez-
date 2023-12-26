<?php
    require('inc/essentials.php');
    require('inc/db-config.php');
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>Admin Panel - Dashboard | <?php echo $settings_r['site_title'] ?></title>
    <!-- Customized Color -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="bg-light">
    
    <?php 
        require('inc/header.php');  

        $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `settings`"));

        $users_que = mysqli_query($con,"SELECT `sr_no` FROM `user_cred` ORDER BY `sr_no` DESC LIMIT 1");
        $users = mysqli_fetch_assoc($users_que);

        $users_q = selectAll('user_q');
        $users_q_fetch = mysqli_num_rows($users_q);

        $veh_que = mysqli_query($con,"SELECT `removed`, COUNT(*) AS vehicles FROM `vehicles` 
            WHERE `removed` = 0;");
        $veh = mysqli_fetch_assoc($veh_que);

        $users_i_que = mysqli_query($con, "SELECT `status`, COUNT(*) AS inactive FROM `user_cred` 
            WHERE `status` = 0;");
        $users_ina = mysqli_fetch_assoc($users_i_que);
    ?>   

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3>Dashboard</h3>
                    <?php 
                        if($is_shutdown['shutdown'] == 1){
                            echo "
                                <h6 class='badge bg-danger py-2 px-3 rounded'>Shutdown Mode is Active!</h6>
                            ";
                        }
                    ?>
                </div>

                <div class="row mb-4">

                    <div class="col-md-3 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Total Sells</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                3,243
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="users.php" class="text-decoration-none">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Users</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                <?php echo $users['sr_no']; ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="user_q.php" class="text-decoration-none">
                            <div class="card l-bg-cyan">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-question"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">User Queries</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                <?php echo $users_q_fetch; ?>                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="vehicles.php" class="text-decoration-none">
                            <div class="card l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-car"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Total Vehicles</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                <?php echo $veh['vehicles']; ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="" class="text-decoration-none">
                            <div class="card l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Booked Vehicles</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                57
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="users.php" class="text-decoration-none">
                            <div class="card l-bg-red">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-exclamation"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Inactive Users</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                <?php echo $users_ina['inactive'] ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>
</body>
</html>