<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('assets/inc/links.php'); ?>
    <title>About Us | <?php echo $settings_r['site_title'] ?></title>
</head>

<body class="bg-light">

    <?php require('assets/inc/nav.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">About Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam, veniam sit veritatis earum soluta <br>
            excepturi natus vitae repellat? Maxime laudantium provident recusandae similique
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
                <p>Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Accusantium voluptatum maiores iste eum quis minus?
                    adipisicing elit. Accusantium voluptatum maiores iste eum quis minus
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img class="w-100" src="assets/images/about/about.jpg">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="assets/images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ Vehicles</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="assets/images/about/customers.svg" width="70px">
                    <h4 class="mt-3">200+ Customer</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="assets/images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ Reviews</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="assets/images/about/staff.svg" width="70px">
                    <h4 class="mt-3">200+ staffs</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">Management Team</h3>



    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                    $about_r = selectAll('team_details');
                    $path = ABOUT_IMG_PATH;

                    while($row = mysqli_fetch_assoc($about_r)){
                        echo <<<data
                            <div class="swiper-slide bg-dark text-white text-center overflow-hidden rounded">
                                <img src="$path$row[picture]" class="w-100">
                                <h5 class="mt-2">$row[name]</h5>
                            </div>    
                        data;
                    }
                ?>
            </div>
        </div>
    </div>



    <?php require('assets/inc/footer.php'); ?>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 40,
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
</body>

</html>