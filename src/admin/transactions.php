<?php

    include ("../connection.php");

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: admin_login.php?restricted-adm");

    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Transactions</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="../css/admin_tbl.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/pending.css">

    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png"/>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

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
                        <a class="nav-link opt" href="admin_page.php">
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
                        <a class="nav-link opt active" href="transactions.php">
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
    <!--This is section-->
	<section id="sections" class="py-4 mb-2 bg-faded">
        <div class="msg">
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
        </div>
	</section>
    <section id="post">
		<div class="container">
            
            <div class="tbl-list">
                <label for="">Transaction Table List</label>
                <a href="transactions.php" class="refresh">
                    <span class="fa-solid fa-rotate-right"></span>
                </a>
                <form method="POST" action="" class="form-sort">
                    <div class="form-inline">
                        <select class="form-select" name="payment_option">
                            <option selected>Select Payment Option</option>
                            <option value="GCash">Gcash</option>
                            <option value="PayMaya">PayMaya</option>
                        </select>
                        <button class="btn sort" name="sort">Sort</button>
                        <button class="btn reset" name="reset">Reset</button>
                    </div>
                </form>
            </div>  
                
			<div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tbl-req" id="table-list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tutor ID</th>
                                        <th>Transaction ID</th>
                                        <th>Payment Option</th>
                                        <th>Income</th>
                                        <th>Amount Paid</th>
                                        <th>Date of Payment</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <?php include 'sort_transaction.php'?>
                                </tbody>
                    </table>    
                </div>
			</div>
		</div>
	</section>

    
  </body>
</html>