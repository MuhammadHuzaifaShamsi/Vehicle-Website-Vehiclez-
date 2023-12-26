<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('assets/inc/links.php'); ?>
    <title>Home | <?php echo $settings_r['site_title'] ?></title>
</head>
<body>
    <?php require('assets/inc/nav.php'); ?>

    <!-- SHOWCASE -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper showcase-swiper">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');

                    while($row = mysqli_fetch_assoc($res))
                    {
                        $path = CAROUSEL_IMG_PATH;
                        echo <<<data
                            
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="w-100 d-block" />
                            </div>            
                        data;
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- VEHICLES -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Vehicles</h2>

    <div class="container">
        <div class="row">
            <?php 
                $veh_res = select("SELECT * FROM `vehicles` WHERE `status`=? AND `removed`=? ORDER BY `sr_no` DESC LIMIT 3",[1,0],'ii');

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
                        $book_btn = "<button class='btn btn-sm text-white custom-bg shadow-none' 
                            data-bs-toggle='modal' data-bs-target='#buy_rentModal'>Book Now</button>";
                    }
                    else{
                        $book_btn = "<button disabled  class='btn btn-sm text-white'>Booking Unavailable!</button>";
                    }
                    
                    // print vehicle card
                    echo <<<data
                        <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                <img src="$veh_thumb" class="card-img-top">
                                <div class="card-body">
                                    <h5>$veh_data[name]</h5>
                                    <h6 class="mb-4">$veh_data[price] PKR</h6>
                                    <div class="features mb-4">
                                        <h6 class="mb-1">Features</h6>
                                        $fea_data
                                    </div>
            
                                    <div class="space mb-4">
                                        <h6 class="mb-1">Space</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">
                                            $veh_data[space]
                                        </span>
                                    </div>
            
                                    <div class="rating mb-4">
                                        <h6 class="mb-1">Rating</h6>
                                        <span class="badge rounded-pill bg-light">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-evenly mb-2">$book_btn</div>
                                </div>
                            </div>
                        </div>
                        
                    data;
                }
            ?>
            
            <div class="col-lg-12 text-center mt-5">
                <a href="vehicles.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">
                    More Vehicles >>>
                </a>
            </div>
        </div>
    </div>

    <!-- FACILITIES -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Facilities</h2>

    <div class="container mt-5">
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
                <?php
                    $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `sr_no` DESC LIMIT 5");
                    $path = FACILITIES_IMG_PATH;

                    while($row = mysqli_fetch_assoc($res)){
                        echo <<<data
                            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                                <img src="$path$row[icon]" width="50px">
                                <h5 class="mt-3">$row[name]</h5>
                            </div>
                        data;
                    }
                ?>
                
                <div class="col-lg-12 text-center mt-5">
                    <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">
                        More Facilities >>>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TESTIMONIALS -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>

    <div class="container mt-5">
        <div class="swiper testimonials-swiper">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 1</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 2</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 3</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 4</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 5</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User 6</h6>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo consectetur fugiat non nulla
                        sequi aliquam omnis
                        id rerum provident! Ducimus.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT US -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Contact Us</h2>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded" height="320px"
                        src="<?php echo $contact_r['iframe'] ?>"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    
                </div>
            </div>

            <div class="col-lg-4 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <h5 class="fw-bold">Call Us</h5>  
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php
                        if($contact_r['pn2']!=''){
                            echo <<<data
                                <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                                </a>
                            data;
                        }
                    ?>
                    
                </div>
                
                <div class="bg-white rounded shadow p-4 mt-5">
                    <h5 class="fw-bold">Follow Us</h5>
                    <?php
                        if($contact_r['tw']!=''){
                            echo <<<data
                                <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 mb-1" target="_blank">
                                    <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-twitter me-1"></i> Twitter
                                    </span>
                                </a> <br>  
                            data;
                        }
                    ?>

                    
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-1" target="_blank">
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a> <br>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-1" target="_blank">
                        <span class="badge bg-light text-dark fs-6 p-2">    
                        <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <?php require('assets/inc/footer.php'); ?>
    <script>
        var swiper = new Swiper(".showcase-swiper", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: ({
                delay: 2500,
                disableOnInteraction: false,
            })
        });

        var swiper = new Swiper(".testimonials-swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
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