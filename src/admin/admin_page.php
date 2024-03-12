<?php
    include ("../connection.php");

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: admin_login.php?restricted-adm");

    }
    
    $id = $_SESSION['admin_id'];
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!--for copy icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href ="../css/admin_page.css">

    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png"/>

  </head>
  <body>

    

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo.png" alt="" width="40" height="34">
            </a>
            <a class="navbar-brand" href="">
                <h2 class="learn">Learn</h2>
            </a>
            <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link opt active" href="admin_page.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <label>dashboard</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="tutor_verification_request.php">
                            <i class="fa-solid fa-square-check"></i>
                            <label>tutor request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="std_verification_req.php">
                            <i class="fa-solid fa-circle-check"></i>
                            <label>student request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="transactions.php">
                            <i class="fa-solid fa-receipt"></i>
                            <label>transactions</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="reports/admin_reports.php">
                            <i class="fa-solid fa-print"></i>
                            <label>reports</label>
                        </a>
                    </li>
                </ul>
                <!-- <div class="dropdown">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                    <button type="button" class="btn dt" data-bs-toggle="dropdown" aria-expanded="false" id="<?php echo $id; ?>" onclick="load_unseen_notification(view)">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill count" style="border-radius:10px; background: #2d5f74;"></span>
                        <i class="fa-solid fa-bell"></i>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end dd">

                    </ul>
                </div> -->
                
                <div class="topbar-divider d-none d-sm-block"></div>
                <span class="navbar-text">
                    <div class="btn-group">
                        <div class="ddown flex-nowrap btn-group" data-bs-toggle="dropdown" aria-expanded="false">
                            <button class="fullname"><?php echo $_SESSION['name']; ?></button>
                            <img src="../assets/avatar.png" class="profile-pic" alt="">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end justify-content-center shadow animated--grow-in">
                            <li><a class="dropdown-item" href="admin_acc_sett.php">Account settings</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="admin_logout.php" style="color: red;">Log out</a></li>
                        </ul>
                    </div>
                </span>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="tbl-list">
            <label for=""></label>
            <a href="admin_page.php" class="refresh">
                <span class="fa-solid fa-rotate-right"></span>
            </a>
        </div>   
        <div class="row">

            <!-- STUDENTS Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 std">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-uppercase mb-1 stdhead">
                                    TOTAL REGISTERED STUDENTS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                        
                                        $query = "SELECT id FROM students ORDER BY id";  
                                        $query_run = mysqli_query($conn, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h4> Total Students: '.$row.'</h4>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                            <i class="fa-solid fa-graduation-cap fa-2x "></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="student_table.php">
                            <button class="view-std">
                                <label for="back" class="back-lbl">View Table</label><span class="fa-solid fa-arrow-right"></span>
                            </button>    
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Tutor Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 tut">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-success text-uppercase mb-1 tuthead">
                                TOTAL REGISTERED TUTORS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        
                                        $query = "SELECT id FROM tutors ORDER BY id";  
                                        $query_run = mysqli_query($conn, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h4> Total Tutors: '.$row.'</h4>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-chalkboard-user fa-2x"></i></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tutor_table.php">
                            <button class="view-tut">
                                <label for="back" class="back-lbl">View Table</label><span class="fa-solid fa-arrow-right"></span>
                            </button>   
                        </a>
                    </div>
                </div>
            </div>
    
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 pen">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-uppercase mb-1 penhead">
                                    Tutor Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        
                                        $query = "SELECT id FROM tutors WHERE verification_status = 'Pending' ORDER BY id";  
                                        $query_run = mysqli_query($conn, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h4> Pending: '.$row.'</h4>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-sharp fa-solid fa-clipboard-list fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="pending_req.php">
                            <button class="view-pen">
                                <label for="back" class="back-lbl">View Table</label><span class="fa-solid fa-arrow-right"></span>
                            </button>   
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Pending Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 tran">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-uppercase mb-1 tranhead">
                                    Student Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        
                                        $query = "SELECT id FROM students WHERE verification_status = 'Pending' ORDER BY id";  
                                        $query_run = mysqli_query($conn, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h4> Pending: '.$row.'</h4>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-user fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="student_pending_req.php">
                            <button class="view-tran">
                                <label for="back" class="back-lbl">View Table</label><span class="fa-solid fa-arrow-right"></span>
                            </button>   
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        

    <!--script for notif-->
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "admin_fetch.php",
                    method: "POST",
                    data: {
                        view: view,
                        ids: "<?php echo $id; ?>"
                    },
                    dataType: "json",
                    success: function(data) {
                        // .dd class ng <ul> dropdown
                        $('.dd').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }
            load_unseen_notification();

            // .dt class ng button
            $(document).on('click', '.dt', function() {
                $('.count').html('');
                load_unseen_notification('yes');
            });
            setInterval(function() {
                load_unseen_notification();;
            }, 500);
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
