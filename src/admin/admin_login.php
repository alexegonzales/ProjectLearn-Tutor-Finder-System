<?php

    include ("../connection.php");

    error_reporting(0);

    session_start();

    $error="";


    if(isset($_POST['submit'])) {

        //declare email and password variables
        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        //check if email exist
        $select_email = "SELECT * FROM admin WHERE email = '$email'";
	    $check_email = mysqli_query($conn, $select_email);

		if($check_email->num_rows > 0) {

			//check status (login attempts)
            $select_status = "SELECT * FROM admin WHERE status != 0 AND email = '$email'";
			$check_status = mysqli_query($conn, $select_status);

            $rows = mysqli_fetch_assoc($check_status);

			if($check_status->num_rows > 0) {

                //establish session for email 
				
                $_SESSION['email'] = $rows['email'];

				//check all
                $select_all = "SELECT * FROM admin WHERE email = '$email' AND password = '$pass' AND status != 0";
				$check_all = mysqli_query($conn, $select_all);

				if($check_all->num_rows > 0) {

                    //establish session for password and the rest of the columns
                    $_SESSION['admin_id'] = $rows['admin_id'];  
                    $_SESSION['name'] = $rows['name'];
                    $_SESSION['password'] = $rows['password'];

                    // $tutor_status = "Active now";
                    // $sql2 = mysqli_query($conn, "UPDATE admin SET tutor_status = '{$tutor_status}' WHERE unique_id = {$rows['unique_id']}");

					//reset status
					$reset_status = mysqli_query($conn, "UPDATE admin SET status = '3' WHERE email = '$email'");

					//redirect to this page
					header("location:admin_page.php");

				}else {
                        
					//if password is incorrect,  minus status -1
					//get the value of status (SESSION[email])
					$get_status = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$_SESSION[email]'");

					while($rows = mysqli_fetch_array($get_status)) {

						$current_status = $rows['status'];
						$new_status = $current_status - 1;
                        
					}

                    //update status in database
					$update_status = mysqli_query($conn, "UPDATE admin SET status = '$new_status' WHERE email = '$_SESSION[email]'");

					if($update_status) {

						if($new_status == 0) {

								//update lock attempt
								date_default_timezone_set('Asia/Manila');
								$timer = strtotime("now +22 seconds");
								$time_stamp = date('M d, Y h:i:s a', $timer);

								$update_lock_date = mysqli_query($conn, "UPDATE admin SET lock_date = '$time_stamp' WHERE email = '$_SESSION[email]'");

						}else {

								$error = "Wrong password! Attempt: " . $new_status;
						}
					}
				}
            }

		}else {

				//account doesn' t exist
				$error = "Account doesn't exist";
		}

	}
    //session for page redirection (using $_GET)
    if(isset($_GET['restricted-adm'])) {

        echo "<script>alert('Restricted Page!')</script>";

    }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <link rel="stylesheet" type="text/css" href ="../css/logstyle.css">

    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png" />

  </head>
  <body>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>   

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5" style="background: #FFC300;">
                        <img src="../assets/admin.png" class="login-card-img-admin" alt="">
                    </div>
                    <div class="col-md-7">
                        <a href="homepage_admin.php" class="btn-back-a">
                            <button class="btn-back">
                                <span class="fas fa-arrow-left back"><label for="back" class="back-lbl">Back</label></span>
                            </button>     
                        </a>
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>   
                            </div>
                            <form action="" method="POST" class="login-email">  
                                <div class="input-group">
                                    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="input form-control" name="password"  id="password" placeholder="Password" required aria-label="password" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <i class="fa fa-eye d-none" aria-hidden="true" id="hide_eye"></i>
                                            <i class="fa fa-eye-slash" aria-hidden="true" id="show_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <h6 class="error-msg"><?= $error; ?></h6>
                                <!-- Display the countdown timer in an element -->
                                <h5 id="demo" style = "color: red; text-align: center; padding-bottom: 3%;"></h5>
                                <div class="input-group">
                                    <button class="btn" name="submit">Login</button>
                                </div>
                                <p class="login-register-text" style="text-align:center;">Don't have an account?<a href="admin_reg.php"> Register Here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>

        // Set the date we're counting down to
        var database_lock_date = "<?php 
                                        $get_lock_date  = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$_SESSION[email]'");

                                        while($rows = mysqli_fetch_array($get_lock_date)) {

                                            echo $rows['lock_date'];
                                        }
        ?>";

        var countDownDate = new Date(database_lock_date).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            if(database_lock_date != "")
                document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {

                clearInterval(x);
                document.getElementById("demo").innerHTML = "";
                $.ajax({
                    url: "admin_reset.php",
                    success:function() {

                        alert("Please login again");
    
                    }
                });
            }
        }, 1000);

    </script>

    <!--script (function for password visibility)-->
    <script>
        function password_show_hide() {

            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");

            if (x.type === "password") {

                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";

            } else {

                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
  </body>
</html>