<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p><?php echo $settings_r['site_about'] ?></p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="vehicles.php" class="d-inline-block mb-2 text-dark text-decoration-none">Vehicles</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact</a><br>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow Us</h5>
            <?php
                if($contact_r['tw']!=''){
                    echo <<<data
                        <a href="$contact_r[tw]" class="d-inline-block mb-2 text-dark text-decoration-none" target="_blank"><i
                        class="bi bi-twitter me-1"></i>Twitter</a>
                        <br>
                    data;
                }
            ?>
            
            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none" target="_blank"><i
                    class="bi bi-facebook me-1"></i>
                Facebook</a>
            <br>
            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none" target="_blank"><i
                    class="bi bi-instagram me-1"></i>
                Instagram</a>

        </div>
    </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">&copy; 2023 Copyright: <?php echo $settings_r['site_title'] ?></h6>

<script src="assets/inc/common.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    