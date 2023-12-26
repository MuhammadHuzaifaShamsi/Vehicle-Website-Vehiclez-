<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('assets/inc/links.php'); ?>
    <title>Facilities | <?php echo $settings_r['site_title'] ?></title>
    <style>
        .fac-hov:hover{
            border-top-color: rgb(33, 196, 196) !important;
        }
    </style>
</head>

<body class="bg-light">

    <?php require('assets/inc/nav.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam, veniam sit veritatis earum soluta <br>
            excepturi natus vitae repellat? Maxime laudantium provident recusandae similique
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res)){
                    echo <<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark fac-hov">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="$path$row[icon]" width="40px">
                                    <h5 class="m-0 ms-3">$row[name]</h5>
                                </div>
                                <p>$row[description]</p>
                            </div>
                        </div>
                    data;
                }
            ?>
        
        </div>
    </div>


    <?php require('assets/inc/footer.php'); ?>
</body>

</html>