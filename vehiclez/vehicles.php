<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('assets/inc/links.php'); ?>
    <title>Vehicles | <?php echo $settings_r['site_title'] ?></title>
</head>

<body class="bg-light">

    <?php require('assets/inc/nav.php'); ?>


    <h2 class="mt-5 pt-4 text-center fw-bold h-font">Vehicles</h2>
    <div class="h-line bg-dark "></div>

    <div class="container-fluid my-5">
        <div class="row">

            <!-- FILTERS SECTION -->
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 ps-4">
                <nav class="navbar navbar-expand-lg bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Filters</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Features</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f1">AC</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f2">New</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f3">Less Oil Consumption</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f4" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f4">260 High Speed</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f5" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f5">Second Hand</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>

            <!-- CARDS SECTION -->
            <div class="col-lg-9 col-md-12 px-4">
                <?php 
                    $veh_res = select("SELECT * FROM `vehicles` WHERE `status`=? AND `removed`=? ORDER BY `sr_no` DESC",[1,0],'ii');

                    while($veh_data = mysqli_fetch_assoc($veh_res))
                    {
                        // get features of vehicles
                        $fea_q = mysqli_query($con,"SELECT f.name FROM `feature` f 
                        INNER JOIN `vehicles_features` vfea ON f.sr_no = vfea.features_sr_no 
                        WHERE vfea.vehicle_sr_no = '$veh_data[sr_no]'");

                        $fea_data = "";
                        while($fea_row = mysqli_fetch_assoc($fea_q)){
                            $fea_data .="<span class='badge rounded-pill bg-light text-dark text-wrap lh-base'>
                                $fea_row[name]
                            </span>";
                        }
                        
                        // get thumbnail of image
                        $veh_thumb = VEHICLES_IMG_PATH."thumbnail.jpg";
                        $thumb_q = mysqli_query($con,"SELECT * FROM `vehicle_images` 
                            WHERE `vehicle_sr_no`='$veh_data[sr_no]' AND `thumb`='1'");
                        
                        if(mysqli_num_rows($thumb_q)>0){
                            $thumb_res = mysqli_fetch_assoc($thumb_q);
                            $veh_thumb = VEHICLES_IMG_PATH.$thumb_res['image'];
                        }

                        $book_btn = "";

                        if(!$settings_r['shutdown']){
                            $book_btn = "<a href='#' class='btn btn-sm w-100 text-white custom-bg shadow-none'
                                data-bs-toggle='modal' data-bs-target='#buy_rentModal'>Book Now</a>";
                        }
                        else{
                            $book_btn = "<button disabled  class='btn btn-sm w-100 text-white'>Booking Unavailable!</button>";
                        }

                        // print vehicle card
                        echo <<<data
                            <div class="card mb-4 border-0 shadow">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                        <img src="$veh_thumb" class="img-fluid w-100">
                                    </div>
                                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                        <h5 class="mb-3">$veh_data[name]</h5>
                                        <div class="features mb-3">
                                            <h6 class="mb-1">Features</h6>
                                            $fea_data
                                        </div>
                                        <div class="space mb-3">
                                            <h6 class="mb-1">Space</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">
                                                $veh_data[space]
                                            </span>
                                        </div>
                                        <div class="rating">
                                            <h6 class="mb-1">Rating</h6>
                                            <span class="badge rounded-pill bg-light">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h6 class="mb-4">$veh_data[price] PKR</h6>
                                        $book_btn
                                    </div>
                                </div>
                            </div>
                        data;
                    }
                ?>
                
            </div>
        </div>
    </div>

    

    
    <?php require('assets/inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</body>

</html>




<!-- RENT OR BUY MODAL -->
<div class="modal fade" id="buy_rentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5"><i class="bi bi-question-diamond-fill me-1" 
            style="font-size: 23px;"></i> What to Buy or Rent a Vehicle</h1>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button class="text-secondary border-0 bg-white" style="font-size: 18px;" data-bs-toggle="modal" 
            data-bs-target="#buyModal">Buy Now >>></button> 
        <br><br>
        <button class="text-secondary border-0 bg-white" style="font-size: 18px;" data-bs-toggle="modal" 
            data-bs-target="#rentModal">Rent Now >>></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- BUY MODAL -->
<div class="modal fade" id="buyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="buy_form">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><i class="bi bi-wallet2 me-1" 
                    style="font-size: 23px;"></i> Buy a Vehicle</h1>
            </div>
            <div class="modal-body">
                <div id="buy-image-alert"></div>
                <h5 class="fw-bold h-font mb-2">Choose Payment Method</h5>
                <div class="mb-2">
                    <input type="radio" id="b1" name="buy_payment_method" value="VISA">
                    <label for="b1">VISA</label>
                    <br>
                    <input type="radio" id="b2" name="buy_payment_method" value="Master Card">
                    <label for="b2">Master Card</label>
                    <br>
                    <input type="radio" id="b3" name="buy_payment_method" value="Cash">
                    <label for="b3">Cash</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#buy_rentModal">Close</button>
                <button type="button" onclick="buy()" class="btn custom-bg shadow-none">Submit</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Rent MODAL -->
<div class="modal fade" id="rentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="rent_form">
        <div class="modal-header">
            <h1 class="modal-title fs-5"><i class="bi bi-bank2 me-1" 
                style="font-size: 23px;"></i> Rent a Vehicle</h1>
        </div>
        <div class="modal-body">
            <div id="image-alert"></div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <h5 class="fw-bold h-font mb-3">Rent Start and End Time</h5>
                    <label class="form-label">Rent Start</label>
                    <input type="date" id="rstart" required class="form-control shadow-none mb-2">
                    <label class="form-label">Rent End</label>
                    <input type="date" id="rend" required class="form-control shadow-none">
                </div>
                
                <div class="col-lg-6">
                    <h5 class="fw-bold h-font mb-3">Choose Payment Method</h5>
                    <input type="radio" id="p1" name="payment_method" value="VISA">
                    <label for="p1">VISA</label>
                    <br>
                    <input type="radio" id="p2" name="payment_method" value="Master Card">
                    <label for="p2">Master Card</label>
                    <br>
                    <input type="radio" id="p3" name="payment_method" value="Cash">
                    <label for="p3">Cash</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#buy_rentModal">Close</button>
            <button type="button" onclick="rent()" class="btn custom-bg shadow-none">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>