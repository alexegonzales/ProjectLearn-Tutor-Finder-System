<?php

    include 'connection.php';

    error_reporting(0);

    session_start();

    $error="";

    if(isset($_POST['submit'])) {

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['confirmpassword'];
        $sex = $_POST['sex'];

        $emailPattern = "/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/";
        $namePattern = "/^\s+|[\d]$/";
        $passPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

        if (preg_match($namePattern, $fname) == 1) {

           $error ="Invalid First name. Whitespaces and digits are not allowed.";

        }elseif (preg_match($namePattern, $lname) == 1) {

            $error ="Invalid Last name. Whitespaces and digits are not allowed.";
        
        }elseif (preg_match($emailPattern, $email) == 0) {

            $error ="Invalid Email!";
        
        }elseif (preg_match($passPattern, $pass) == 0) {

            $error ="Password must contain atleast one uppercase letter, one lowercase letter, and atleast a digit";

        }elseif ($pass == $cpass) {

            $select = "SELECT * FROM students WHERE email='$email'";

            $select_result = mysqli_query($conn, $select);

            if($select_result->num_rows > 0) {

                $error= "User already exist!";
                    
            }else {

                $profile = 'avatar.png';

                $contact = "No input";

                $ran_id = rand(time(), 100000000);
                
                $student_status = "Offline now";

                $hashPass = md5($pass);

                $verification_status = "Pending";

                $imageName = $_FILES["credential"]["name"];
                $imageSize = $_FILES["credential"]["size"];
                $tmpName = $_FILES["credential"]["tmp_name"];
    
                // Image validation
                $validImageExtension = ['jpg', 'jpeg', 'png', 'pdf'];
                $imageExtension = explode('.', $imageName);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validImageExtension)){
    
                    echo
                        "
                        <script>
                        alert('Invalid Image Extension');
                        document.location.href = 'student_reg.php';
                        </script>
                        ";
    
                }elseif ($imageSize > 1200000){
    
                    echo
                        "
                        <script>
                        alert('Image Size Is Too Large');
                        document.location.href = 'student_reg.php';
                        </script>
                        ";
    
                }else {

                    $insert = "INSERT INTO students (unique_id, firstname, lastname, email, profile, contact, password, sex, status, student_status, verification_status, credential)
                        VALUES ('$ran_id', '$fname', '$lname', '$email', '$profile', '$contact', '$hashPass', '$sex', 3, '$student_status', '$verification_status', '$imageName')";

                    $insert_result = mysqli_query($conn, $insert);

                    move_uploaded_file($tmpName, 'credentials/' . $imageName);

                    if($insert_result) {

                        echo "<script>alert('Registration completed!'); window.location.href='student_login.php';</script>";
                        
                        $fname = "";
                        $lname = "";
                        $uname = "";
                        $email = "";
                        $_POST['password'] = "";
                        $_POST['confrimpassword'] = "";

                    }else {

                        $error= "Woops! Something went wrong.";

                    }
                }
            }

        }else {

            $error= "Password not matched!";
            
        }
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

    <link rel="stylesheet" type="text/css" href ="css/regstyle.css">
    <!-- <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/regstyle.css"> -->

    <title>Student Registration Form</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />
  </head>
  <body>
        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-5" style="background: #FFC300;">
                            <img src="assets/study.png" class="login-card-img" alt="">
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
                                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
                                <form action="" method="POST" class="login-email" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <input type="text" name="firstname" placeholder="First name" value="<?php echo $fname; ?>" required>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="lastname" placeholder="Last name" value="<?php echo $lname; ?>" required>
                                    </div>
                                    <div class="input-group">
                                        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" class="input form-control" name="password"  id="password" placeholder="Password" minlength="8" required aria-label="password" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide();">
                                                <i class="fa fa-eye d-none" aria-hidden="true" id="hide_eye"></i>
                                                <i class="fa fa-eye-slash" aria-hidden="true" id="show_eye"></i>
                                            </span>   
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" class="input form-control" name="confirmpassword" id="cpassword" placeholder="Confirm password" minlength="8" required aria-label="cpassword" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="cpassword_show_hide();">
                                                <i class="fa fa-eye d-none" aria-hidden="true" id="chide_eye"></i>
                                                <i class="fa fa-eye-slash" aria-hidden="true" id="cshow_eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="radio-group">
                                            <label class="lbl-radio">Sex :</label>
                                            <input type="radio" name="sex" value="male" required>
                                            <label class="lbl-radio">Male</label>
                                            <input type="radio" name="sex" value="female">
                                            <label class="lbl-radio">Female</label>
                                    </div>
                                    <div id="credential" class="form-text">Upload a parent's consent letter in a pdf form</div>
                                    <input type="file" name="credential"  id="credential" class="form-control up" accept=".jpg, .jpeg, .png, .pdf" required>
                                    <h6 class="error-msg"><?= $error; ?></h6>
                                    <div class="input-group">
                                        <button class="btn" name="submit">Register</button>
                                    </div>
                                    <p class="login-register-text">Already have an account? <a href="student_login.php">Login Here</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </main>
    
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

    <script>
        function cpassword_show_hide() {

            var x = document.getElementById("cpassword");
            var cshow_eye = document.getElementById("cshow_eye");
            var chide_eye = document.getElementById("chide_eye");
            chide_eye.classList.remove("d-none");

            if (x.type === "password") {

                x.type = "text";
                cshow_eye.style.display = "none";
                chide_eye.style.display = "block";

            } else {

                x.type = "password";
                cshow_eye.style.display = "block";
                chide_eye.style.display = "none";
            }
        }

    </script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
 
  </body>
</html>