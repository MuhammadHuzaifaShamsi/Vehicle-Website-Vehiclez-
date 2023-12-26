<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('assets/inc/links.php'); ?>
    <title>Your Profile | <?php echo $settings_r['site_title']?></title>
</head>
<body class="bg-light">

    <?php 
        require('assets/inc/nav.php');

        if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
            redirect('index.php');
        }

        $u_exist = select("SELECT * FROM `user_cred` WHERE `sr_no`=? LIMIT 1",[$_SESSION['uid']],'s');

        if(mysqli_num_rows($u_exist)==0){
            redirect('index.php');
        }
        else{
            $u_fetch = mysqli_fetch_assoc($u_exist);
        }
    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">Profile</a>
                </div>
            </div>

            <div class="col-12 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="info_form">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo $u_fetch['name'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="pn" value="<?php echo $u_fetch['pn'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo $u_fetch['dob'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">CNIC</label>
                                <input type="number" name="cnic" value="<?php echo $u_fetch['cnic'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-lg-8 mb-4">
                                <label class="form-label">Address</label>
                                <textarea name="address" required class="form-control shadow-none" rows="1"><?php echo $u_fetch['address'] ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-4 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="profile_form">
                        <h5 class="mb-3 fw-bold">Profile Picture</h5>
                        <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile']?>" class="rounded-circle img-fluid mb-3">
                        <br>
                        <label class="form-label fw-bold">New Picture</label>
                        <input type="file" name="profile" accept=".jpg, .png, .jpeg, .webp" required class="form-control shadow-none mb-4">
                        
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="pass_form">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="pass" required class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpass" required class="form-control shadow-none">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn custom-bg text-white shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>





    <?php require('assets/inc/footer.php'); ?>
    <script src="assets/inc/profile.js"></script>
</body>
</html>