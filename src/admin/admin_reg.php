<?php
    include ("../connection.php");

    error_reporting(0);

    session_start();

    $error="";

    if(isset($_POST['submit'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['confirmpassword'];
        
        $emailPattern = "/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/";
        $namePattern = "/^\s+|[\d]$/";
        $passPattern = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/i";
       

        if (preg_match($namePattern, $name) == 1) {

            $error ="Invalid name. Whitespaces or digits are not allowed.";

        }elseif (preg_match($emailPattern, $email) == 0) {

            $error ="Invalid Email!";
        
        }elseif (preg_match($passPattern, $pass) == 0) {

            $error ="Password must contain atleast one uppercase letter, one lowercase letter, or atleast a digit";

        }elseif($pass == $cpass) {

            $select = "SELECT * FROM admin WHERE email='$email'";

            $select_result = mysqli_query($conn, $select);

            if($select_result->num_rows > 0) {

                $error= "Admin already exist!";
                    
            }else {
                

                $hashPass = md5($pass);

                $insert = "INSERT INTO admin (name, email, password, status)
                    VALUES ('$name', '$email', '$hashPass', 3)";

                $insert_result = mysqli_query($conn, $insert);

                if($insert_result) {

                    echo "<script>alert('Registration completed!'); window.location.href='admin_login.php';</script>";
                    
                    $name = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['confrimpassword'] = "";

                }else {

                    $error= "Woops! Something went wrong.";

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Registration Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <link rel="stylesheet" type="text/css" href ="../css/admin_reg.css">

    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png" />
    


  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-5" style="background: #FFC300;">
                            <img src="../assets/admin.png" class="login-card-img" alt="">
                        </div>
                        <div class="col-md-7">
                            <a href="homepage_admin.php" class="btn-back-a">
                                <button class="btn-back">
                                    <span class="fas fa-arrow-left back"><label for="back" class="back-lbl">Back</label></span>
                                </button>      
                            </a>
                            <div class="card-body">
                                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
                                <form action="" method="POST" class="login-email">
                                    <div class="input-group">
                                        <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
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
                
                                    <h6 class="error-msg"><?= $error; ?></h6>
                                    <div class="input-group">
                                        <button class="btn" name="submit">Register</button>
                                    </div>
                                    <p class="login-register-text">Already have an account? <a href="admin_login.php">Login Here</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </main>


    <!--script for toggle eye button-->
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
  </body>
</html>