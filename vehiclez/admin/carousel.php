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
    <title>Admin Panel - Carousel | <?php echo $settings_r['site_title'] ?></title>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php');  ?>   

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Carousel</h3>

                <!-- Carousel Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Images</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="row" id="carousel_data"></div>

                    </div>
                </div>

                <!-- Carousel Modal Section -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Add Image</h1>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Picture</label> <br>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap lh-base mb-2">Only jpg, png, jpeg, and webp format allowed!</span>
                                    <input type="file" name="carousel_picture" required id="carousel_picture_inp" class="form-control shadow-none">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="carousel_picture.value='';" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" onclick="add_image()" class="btn custom-bg shadow-none">Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/carousel.js"></script>

</body>
</html>