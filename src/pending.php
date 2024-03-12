<?php
    include 'connection.php';

    session_start();
    
    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-tch");
       
    }


    //to get the updated profile
    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tutors WHERE id = $id"));

    $profile = $rowimg['profile'];


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- font awesome for icons, etc-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="css/pending.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/pending.css">

	<link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    <script src="js/notif.js"></script>

  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png" alt="" width="40" height="34">
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
                        <a class="nav-link opt" href="tutor_page.php">
                            <i class="fa-regular fa-calendar"></i>
                            <label>schedule</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="tutor_add_topic.php">
                            <i class="fa-solid fa-square-plus"></i>
                            <label>add topic</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="students.php">
                            <i class="fa-solid fa-message"></i>
                            <label>chat</label>
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link opt active" href="pending.php">
                            <i class="fa-solid fa-table-list"></i>
                            <label>student list</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="tutor_ratings.php?id=<?php echo $_SESSION['id']; ?>">
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <label>my ratings</label>
                        </a>
                    </li>
                </ul>
                <div class="dropdown">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                    <button type="button" class="btn dt" data-bs-toggle="dropdown" aria-expanded="false" id="<?php echo $id; ?>" onclick="load_unseen_notification(view)">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill count" style="border-radius:10px; background: #2d5f74;"></span>
                        <i class="fa-solid fa-bell"></i>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end dd">

                    </ul>
                </div>
                <div class="topbar-divider d-none d-sm-block"></div>
                
                <span class="navbar-text">
                    <div class="btn-group">
                        <div class="ddown flex-nowrap btn-group" data-bs-toggle="dropdown" aria-expanded="false">
                            <input type="button" class="fullname" value="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>">
                            <img src="uploads/<?php echo $profile; ?>" class="profile-pic" alt="">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end justify-content-center">
                            <li><a class="dropdown-item" href="tutor_acc_sett.php">Account settings</a></li>
                            <li><a class="dropdown-item" href="tutor_change_pass.php">Change password</a></li>
                            <div class="dropdown-divider"></div>
                            <?php

                                $sql = mysqli_query($conn, "SELECT * FROM tutors WHERE unique_id = {$_SESSION['unique_id']}");

                                    if(mysqli_num_rows($sql) > 0){
                                        
                                    $row = mysqli_fetch_assoc($sql);
                                    
                                }
                            ?>
                            <li><a class="dropdown-item" href="tutor_logout.php?logout_id=<?php echo $row['unique_id']?>" style="color: red;">Log out</a></li>
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

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['removed'])) { ?>
                <p class="removed"><?php echo $_GET['removed']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['complete'])) { ?>
                <p class="complete"><?php echo $_GET['complete']; ?></p>
            <?php } ?>
        </div>
        
	</section>
    <!----Section2 for showing Post Model ---->
	<section id="post">
		<div class="container">
        <div class="tbl-list">
            <label for="">Request Table List</label>
            <a href="pending.php" class="refresh">
                <span class="fa-solid fa-rotate-right"></span>
            </a>
            <form method="POST" action="" class="form-sort">
                    <div class="form-inline">
                        <select class="form-select" name="req_status">
                            <option selected>Select Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Accepted</option>
                            <option value="2">Rejected</option>
                            <option value="3">Completed</option>
                        </select>
                        <button class="btn sort" name="sort">Sort</button>
                        <button class="btn reset" name="reset">Reset</button>
                    </div>
                </form>
        </div>
			<div class="row">
			    <table class="table table-bordered table-hover table-striped tbl-req" id="table-list">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Request Date</th>
								<th>Request Status</th>
                                <th>Action</th>
							</thead>
							 <tbody>
                                <?php include 'tutor_sort_request.php'?>
							 </tbody>
				</table>
			</div>
		</div>
	</section>


    <script src="js/bootstrap.min.js"></script>

	<!--script for notif-->
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "fetch.php",
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

  </body>
</html>