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
    <title>Admin Panel - Settings | <?php echo $settings_r['site_title'] ?></title>
</head>
<body class="bg-light">
    
    <?php require('inc/header.php');  ?>   

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Settings</h3>

                <!-- General Settings Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>

                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!-- General Settings Modal Section -->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">General Settings</h1>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Site Title</label>
                                    <input type="text" name="site_title" required  id="site_title_inp" class="form-control shadow-none">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">About Us</label>
                                    <textarea name="site_about" required  id="site_about_inp" class="form-control shadow-none" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn text-secondary shadow-none" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" onclick="upd_general(site_title.value, site_about.value)" class="btn custom-bg shadow-none">Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card border-0 shadow-sm bg-white mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input shadow-none" type="checkbox" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text">Shutdown the webstie while making any changes!</p>

                    </div>
                </div>
                
                <!-- Contact Details Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text border p-2" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i> 
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i> 
                                        <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram"></i> 
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-twitter"></i> 
                                        <span id="tw"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Iframe</h6>
                                    <iframe id="iframe" class="border p-2 w-100" height="250" loading="lazy"></iframe>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Contact Details Modal Section -->
                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form>
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Contact Settings</h1>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Address</label>
                                                <input type="text" name="address" required  id="address_inp" class="form-control shadow-none">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Google Map Link</label>
                                                <input type="text" name="gmap" required  id="gmap_inp" class="form-control shadow-none">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Phone Numbers (with country code)</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i> </span>
                                                    <input type="text" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i> </span>
                                                    <input type="text" name="pn2" id="pn2_inp" class="form-control shadow-none">
                                                </div>
                                                <span class="badge bg-light text-dark">* Optional</span>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email" name="email" required  id="email_inp" class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Social Links</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="bi bi-facebook"></i> </span>
                                                    <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="bi bi-instagram"></i> </span>
                                                    <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-twitter"></i> </span>
                                                    <input type="text" name="tw" id="tw_inp" class="form-control shadow-none" required>
                                                </div>
                                                <span class="badge bg-light text-dark">* Optional</span>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Iframe Src</label>
                                                <textarea name="iframe" id="iframe_inp" required cols="30" rows="6" class="form-control shadow-none" required></textarea>
                                            </div>
                                            
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn text-secondary shadow-none" onclick="contacts_inp(contacts_data)" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" onclick="upd_contacts()" class="btn custom-bg shadow-none">Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Management Team Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Management Team</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="row" id="team_data"></div>

                    </div>
                </div>

                <!-- Management Team Modal Section -->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Team Member</h1>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="member_name" required  id="member_name_inp" class="form-control shadow-none">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Picture</label> <br>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap lh-base mb-2">Only jpg, png, jpeg, and webp format allowed!</span>
                                    <input type="file" name="member_picture" required id="member_picture_inp" class="form-control shadow-none">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="member_name.value='',member_picture.value='';" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" onclick="add_member()" class="btn custom-bg shadow-none">Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/settings.js"></script>

</body>
</html>