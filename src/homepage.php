<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Learn</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/homepage.css" rel="stylesheet" />
        <!-- <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/homepage.css"> -->
    </head>
    
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img class="logo" src="assets/img/logo_yellow.png" alt="..." /> Learn</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Preview</a></li>
                        <li class="nav-item"><a class="nav-link" href="#subject">subject</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                    <div class ="content">
			            <h1> Live to Learn</h1>
			                <div class="container mt-3">
				            <div class="dropdown">
    			                <button class="mainbut" type="submit" data-bs-toggle="dropdown"><span></span>Login</button>
      				                <ul class="dropdown-menu">
      					                <li><a class="dropdown-item" href="student_login.php">Student</a></li>
						                <li><hr class="dropdown-divider"></li>
      					                <li><a class="dropdown-item" href="tutor_login.php">Tutor</a></li>
    				                </ul>

  				                <button class="mainbut" type="submit" data-bs-toggle="dropdown"><span></span>Register</button>
      				                <ul class="dropdown-menu">
      					                <li><a class="dropdown-item" href="student_reg.php">Student</a></li>
						                <li><hr class="dropdown-divider"></li>
      			                        <li><a class="dropdown-item" href="tutor_reg.php">Tutor</a></li>
    				                </ul>
				            </div>
			    </div>
		    </div>
        </header>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-regular fa-clock fa-stack-1x fa-inverse"></i>
                            
                        </span>
                        <h4 class="my-3">Time</h4>
                        <p class="text-muted">Having the power to choose the date and time when will the session starts.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-book fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Knowledge</h4>
                        <p class="text-muted">Be exposed on the knowledge shared by the tutor which cannot be learned in books.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-location-dot fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Flexibility</h4>
                        <p class="text-muted">Attend session anywhere with a mobile or computer.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- preview-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">What to see?</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/1.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Easy Registration</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/2.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Tutor List</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/3.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Information of the Tutors</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 4-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal4">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/4.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Messaging System</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 5-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal5">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/5.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Friendly Tutors</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <!-- Portfolio item 6-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal6">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/preview/6.png" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Schedule</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- subject-->
                <section class="page-section" id="subject">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Available Subjects</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/subject/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Science</h4>
                                <h4 class="subheading">Available Content</h4>
                            </div>
                                <div class="timeline-body"><p class="text-muted">1. Biology</p></div>
                                <div class="timeline-body"><p class="text-muted">2. Chemistry</p></div>
                                <div class="timeline-body"><p class="text-muted">3. Physical Science</p></div>
                                <div class="timeline-body"><p class="text-muted">4. Environmental Science</p></div>
                                <div class="timeline-body"><p class="text-muted">Many more...</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/subject/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Math</h4>
                                <h4 class="subheading">Available Content</h4>
                            </div>
                                <div class="timeline-body"><p class="text-muted">1. Algebra 1</p></div>
                                <div class="timeline-body"><p class="text-muted">2. Algebra 2</p></div>
                                <div class="timeline-body"><p class="text-muted">3. Arithmetic Sequence</p></div>
                                <div class="timeline-body"><p class="text-muted">4. Geometry</p></div>
                                <div class="timeline-body"><p class="text-muted">5. Trigonometry</p></div>
                                <div class="timeline-body"><p class="text-muted">Many more...</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid"  src="assets/img/subject/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>English</h4>
                                <h4 class="subheading">Available Content</h4>
                            </div>
                                <div class="timeline-body"><p class="text-muted">1. Inference</p></div>
                                <div class="timeline-body"><p class="text-muted">2. Reading Strategies Using Visualization</p></div>
                                <div class="timeline-body"><p class="text-muted">3. Tone and Mood in a Reading Passage</p></div>
                                <div class="timeline-body"><p class="text-muted">4. Structure in Writing</p></div>
                                <div class="timeline-body"><p class="text-muted">Many more...</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/subject/4.jpeg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Filipino</h4>
                                <h4 class="subheading">Available Content</h4>
                            </div>
                                <div class="timeline-body"><p class="text-muted">1. Panitikang Meditteranean</p></div>
                                <div class="timeline-body"><p class="text-muted">2. Parabula mula Syria</p></div>
                                <div class="timeline-body"><p class="text-muted">3. Sanaysay mula Greece</p></div>
                                <div class="timeline-body"><p class="text-muted">4. Epiko ng Iraq</p></div>
                                <div class="timeline-body"><p class="text-muted">Many more...</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/subject/5.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Arpan</h4>
                                <h4 class="subheading">Available Content</h4>
                            </div>
                                <div class="timeline-body"><p class="text-muted">1. History</p></div>
                                <div class="timeline-body"><p class="text-muted">2. Government</p></div>
                                <div class="timeline-body"><p class="text-muted">3. Economics</p></div>
                                <div class="timeline-body"><p class="text-muted">4. Civics</p></div>
                                <div class="timeline-body"><p class="text-muted">5. Geography</p></div>
                                <div class="timeline-body"><p class="text-muted">Many more...</p></div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
       
    
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Any Concern</h2>
                    <h3 class="gmail">Contact us</h3>
                    <h3 class="gmail"><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=2022projectlearn@gmail.com" target="_blank">2022projectlearn@gmail.com</a></h3>
                </div>
            </div>
        </section>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/1.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/2.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/3.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/4.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/5.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <img class="img-fluid d-block mx-auto" src="assets/img/preview/6.png" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/homepage.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>