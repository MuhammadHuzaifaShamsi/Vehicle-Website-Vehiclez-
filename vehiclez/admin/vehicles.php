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
    <title>Admin Panel - Vehicles | <?php echo $settings_r['site_title'] ?></title>
</head>
<body class="bg-light">
    
    <?php require('inc/header.php');  ?>   

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Vehicles</h3>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#vehicles-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height: 400px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Space</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="vehicles-data"></tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Add Vehicles Modal -->
    <div class="modal fade" id="vehicles-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_vehicle_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Vehicle</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Space</label>
                            <input type="text" name="space"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" name="price"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number" name="quantity" min="1"  class="form-control shadow-none">
                    </div>
                        <div class="col-12 md-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('feature');
                                        
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                                
                            </div>    
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg shadow-none">Save</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Vehicles Modal -->
    <div class="modal fade" id="edit-veh" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_vehicle_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Vehicle</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Space</label>
                            <input type="text" name="space"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" name="price"  class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number" name="quantity" min="1"  class="form-control shadow-none">
                    </div>
                        <div class="col-12 md-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('feature');
                                        
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                                
                            </div>    
                            
                        </div>
                        <input type="hidden" name="vehicle_sr_no" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg shadow-none">Save</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Vehicle Image Modal -->
    <div class="modal fade" id="veh-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .jpeg, .webp" required class="form-control shadow-none mb-3">
                            <button class="btn custom-bg shadow-none">ADD</button>
                            <input type="hidden" name="vehicle_sr_no">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="table-dark sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="vehicle-image-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/vehicles.js"></script>

</body>
</html>