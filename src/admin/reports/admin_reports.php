<?php
    include ("../../connection.php");

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: ../admin_login.php?restricted-adm");

    }
    
    $id = $_SESSION['admin_id'];
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Reports</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">  

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="../css/admin_page.css"> -->
    <!-- <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/pending.css"> -->
    <link rel="stylesheet" type="text/css" href ="../../css/reports.css">

    <link rel="icon" type="image/x-icon" href="../../assets/logo_yellow.png"/>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logo.png" alt="" width="40" height="34">
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
                        <a class="nav-link opt" href="../admin_page.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <label>dashboard</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../tutor_verification_request.php">
                            <i class="fa-solid fa-square-check"></i>
                            <label>tutor request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../std_verification_req.php">
                            <i class="fa-solid fa-circle-check"></i>
                            <label>student request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../transactions.php">
                            <i class="fa-solid fa-receipt"></i>
                            <label>transactions</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt active" href="admin_reports.php">
                            <i class="fa-solid fa-print"></i>
                            <label>reports</label>
                        </a>
                    </li>
                </ul>
                <div class="topbar-divider d-none d-sm-block"></div>
                <span class="navbar-text">
                    <div class="btn-group">
                        <div class="ddown flex-nowrap btn-group" data-bs-toggle="dropdown" aria-expanded="false">
                            <button class="fullname"><?php echo $_SESSION['name']; ?></button>
                            <img src="../../assets/avatar.png" class="profile-pic" alt="">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end justify-content-center shadow animated--grow-in">
                            <li><a class="dropdown-item" href="../admin_acc_sett.php">Account settings</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="../admin_logout.php" style="color: red;">Log out</a></li>
                        </ul>
                    </div>
                </span>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <section id="post">
            <div class="container">
                <label for="" class="title">Printable Reports</label>
                <div class="tbl-list">
                    <a href="admin_reports.php" class="refresh">
                        <span class="fa-solid fa-rotate-right"></span>
                    </a>
                    <form method="POST" action="" class="form-sort">
                        <div class="form-inline">
                            <select class="form-select" name="all_tables" onchange="location = this.value;">
                                <option selected>Select Table</option>
                                <option value="tutors_tbl.php">Tutors</option>
                                <option value="students_tbl.php">Students</option>
                                <option value="transaction_tbl.php">Payment Transactions</option>
                            </select>
                        </div>
                    </form>
                </div>  
                <div class="row">
                <table class='new-tbl'>
                    <thead class='no-record'>
                        <th>No Selected Record Yet</th>
                    </thead>
                </table>
                </div>
            </div>
        </section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>