<?php
    include 'connection.php';

    error_reporting(0);

    //start session
    session_start();

    $error=""; 

    if(isset($_POST['submit'])) {

        //declare email and password variables
        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        //check if email exist
        $select_email = "SELECT * FROM students WHERE email = '$email'";
	    $check_email = mysqli_query($conn, $select_email);

		if($check_email->num_rows > 0) {

			//check status (login attempts)
            $select_status = "SELECT * FROM students WHERE status != 0 AND email = '$email'";
			$check_status = mysqli_query($conn, $select_status);

            $rows = mysqli_fetch_assoc($check_status);

			if($check_status->num_rows > 0) {

                //establish session for email
                $_SESSION['email'] = $rows['email'];
                

				//check all
                $select_all = "SELECT * FROM students WHERE email = '$email' AND password = '$pass' AND status != 0";
				$check_all = mysqli_query($conn, $select_all);


				if($check_all->num_rows > 0) {

                    //establish session for password and the rest of the columns
                    $_SESSION['id'] = $rows['id']; 
                    $_SESSION['unique_id'] = $rows['unique_id'];                               
                    $_SESSION['firstname'] = $rows['firstname'];
                    $_SESSION['lastname'] = $rows['lastname'];
                    $_SESSION['profile'] = $rows['profile'];
                    $_SESSION['contact'] = $rows['contact'];
                    $_SESSION['password'] = $rows['password'];
                    $_SESSION['sex'] = $rows['sex'];
                    $_SESSION['verification_status'] = $rows['verification_status'];

                    $student_status = "Active now";

                    $verification_status = $rows['verification_status'];

                    $sql2 = mysqli_query($conn, "UPDATE students SET student_status = '{$student_status}' WHERE unique_id = {$rows['unique_id']}");

					//reset status
					$reset_status = mysqli_query($conn, "UPDATE students SET status = '3' WHERE email = '$email'");

                    if($verification_status == "Verified") {
                        //redirect to this page
                        echo "<script>
                            alert('Login Successfully!');
                            document.location.href = 'student_page.php';
                            </script>";
                              

					    // header("location:tutor_page.php");
                    } elseif ($verification_status == "Pending"){

                        echo "<script> 
                        		alert('Your account is still pending for approval!');
                        		window.open('student_login.php');
                        	  </script>";

                    } else {
                        echo "<script> 
                        		alert('Your verification request has been declined!');
                        		window.open('student_login.php');
                        	  </script>";
                    }
		

				}else {
                        
					//if password is incorrect,  minus status -1
					//get the value of status (SESSION[email])
					$get_status = mysqli_query($conn, "SELECT * FROM students WHERE email = '$_SESSION[email]'");

					while($rows = mysqli_fetch_array($get_status)) {

						$current_status = $rows['status'];
						$new_status = $current_status - 1;
					}

                    //update status in database
					$update_status = mysqli_query($conn, "UPDATE students SET status = '$new_status' WHERE email = '$_SESSION[email]'");

					if($update_status) {

						if($new_status == 0) {

								//update lock attempt
								date_default_timezone_set('Asia/Manila');
								$timer = strtotime("now +22 seconds");
								$time_stamp = date('M d, Y h:i:s a', $timer);

								$update_lock_date = mysqli_query($conn, "UPDATE students SET lock_date = '$time_stamp' WHERE email = '$_SESSION[email]'");

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
    if(isset($_GET['restricted-std'])) {

        echo "<script>alert('Restricted Page!')</script>";

    }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <!-- <link rel="stylesheet" type="text/css" href ="css/logstyle.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/logstyle.css">
    
    <title>Student Login Form</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

  </head>
  <body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5" style="background: #FFC300;">
                        <img src="assets/teaching.png" class="login-card-img" alt="">
                    </div>
                    <div class="col-md-7">
                        <a href="homepage.php" class="btn-back-a">
                            <button class="btn-back">
                                <span class="btn-icon">
                                    <ion-icon name="arrow-back-outline"></ion-icon>
                                </span>
                                <span class="btn-text">Back</span>
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
                                    <input type="password" class="input form-control" name="password" id="password" placeholder="Password" required aria-label="password" aria-describedby="basic-addon1" >
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <i class="fa fa-eye d-none" aria-hidden="true" id="hide_eye"></i>
                                            <i class="fa fa-eye-slash" aria-hidden="true" id="show_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--  <div class="input-group">
                                    <input type="password" name="password"  id="password" placeholder="Password" required >
                                    <div class="input-group-append" onclick="password_show_hide();">
                                        <span class=""></span>
                                    </div>
                                </div>-->
                                <h6 class="error-msg"><?= $error; ?></h6>
                                <!-- Display the countdown timer in an element -->
                                <h5 id="demo" style = "color: red; text-align: center; padding-bottom: 3%;"></h5>
                                <div class="input-group">
                                    <button class="btn" name="submit">Login</button>
                                </div>
                                <p class="login-register-text" style="text-align:center;">Don't have an account?<a href="student_reg.php"> Register Here</a></p>
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
                                        $get_lock_date  = mysqli_query($conn, "SELECT * FROM students WHERE email = '$_SESSION[email]'");

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
                    url: "student_reset.php",
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>