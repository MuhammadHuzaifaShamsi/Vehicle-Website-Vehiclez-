<nav id="nav-bar" class="navbar navbar-expand-lg bg-white shadow sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand h-font fs-2 fw-bold mx-3" href="index.php"><?php echo $settings_r['site_title'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vehicles.php">Vehicles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php 
                    if(isset($_SESSION['login']) && $_SESSION['login']==true)
                    {
                        $path = USERS_IMG_PATH;
                        echo <<<data
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <img src="$path$_SESSION[upic]" style="width: 25px; height: 25px;" class="rounded-circle me-1">
                                    $_SESSION[uname]
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        data;
                    }
                    else{
                        echo <<<data
                            <button type="button" class="btn btn-outline-dark shadow-none me-3" data-bs-toggle="modal"data-bs-target="#signinModal">
                                Signin
                            </button>
                            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"data-bs-target="#signupModal">
                                Signup
                            </button>
                        data;
                    }
                ?>
                
            </div>
        </div>
    </div>
</nav>

<!-- Signin Modal -->
<div class="modal fade" id="signinModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="signin-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-person-circle me-1"
                            style="font-size: 23px;"></i> Sign In</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / Phone</label>
                        <input type="text" name="email_pn" required class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" required class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Signup Modal -->
<div class="modal fade modal-lg" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="signup-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-person-fill-add me-1"
                            style="font-size: 23px;"></i> Sign Up</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (CNIC, Passport, Driving License etc.) that will
                        be required during buying or renting a vehicle!
                    </span>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" required class="form-control shadow-none">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" required class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">CNIC No#</label>
                            <input type="number" name="cnic" required class="form-control shadow-none">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" required class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="number" name="pn" required class="form-control shadow-none">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="picture" accept=".jpg, .png, .jpeg, .webp" required class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" required class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="cpass" required class="form-control shadow-none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn custom-bg">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


