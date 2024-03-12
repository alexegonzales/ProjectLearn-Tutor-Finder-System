<?php

    include ("../connection.php");

    session_start();
    
    error_reporting(0);

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {
        
        header("location: admin_login.php?restricted-adm");
    }
    
    //Function to change password
    if (isset($_POST['oldpassword']) && isset($_POST['newpassword'])
    && isset($_POST['confirm_newpassword'])) {

        function validate($data) {

            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $oldpass = validate($_POST['oldpassword']);
        $newpass = validate($_POST['newpassword']);
        $c_newpass = validate($_POST['confirm_newpassword']);

        $npassPattern = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/i";

            if (preg_match($npassPattern, $newpass) == 0) {

                header("Location: admin_acc_sett.php?error=Invalid new password");
    
            }elseif ($newpass !== $c_newpass) {

                header("Location: admin_acc_sett.php?error=The confirmation password does not match");
                exit();

            }else {

            // hashing the password
            $hash_oldpass = md5($oldpass);
            $hash_newpass = md5($newpass);

            $id = $_SESSION['admin_id'];

            $sql = "SELECT password FROM admin WHERE admin_id='$id' AND password='$hash_oldpass'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                
                $sql_2 = "UPDATE admin SET password='$hash_newpass'WHERE admin_id='$id'";

                mysqli_query($conn, $sql_2);

                echo "<script> window.location.href = 'admin_login.php'; alert('Your password has been changed successfully.');</script>";

            }else {
                header("Location: admin_cpass.php?error=Current password does not match");
                exit();
            }

        }
    }

    //to get the updated profile
    // $id =  $_SESSION['id'];
    // $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $id"));

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <link rel="stylesheet" type="text/css" href ="../css/admin_cpass.css">

    <title>Admin Account Settings</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png" />

  </head>
  <body>
    <div class="container">

        <a href="admin_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

        <p class="change_pass-text">Account Settings</p>

        <form action="update_email.php" method="post">
        
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>  

            <label for="email">Email</label>
            <div class="input-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>"  aria-label="email" aria-describedby="button-addon2">
                <button class="btn ud" name="update" type="submit" id="button-addon2">Update</button>
            </div>
        </form>

        <form action="" method="post">

            <label for="opassword" class="form-label">Current Password</label>
            <div class="input-group">
                <input type="password" name="oldpassword" id="opassword" class="form-control" placeholder="Current Password" required aria-label="opassword" aria-describedby="basic-addon1">
                <div class="input-group-append">
                        <span class="input-group-text" onclick="opassword_show_hide();">
                        <i class="fa fa-eye d-none" aria-hidden="true" id="ohide_eye"></i>
                            <i class="fa fa-eye-slash" aria-hidden="true" id="oshow_eye"></i> 
                        </span>
                </div>
            </div>

            <label for="npassword" class="form-label">New Password</label>
            <div class="input-group">
                <input type="password" name="newpassword" id="npassword" class="form-control" placeholder="New Password" required aria-label="npassword" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="npassword_show_hide();">
                        <i class="fa fa-eye d-none" aria-hidden="true" id="nhide_eye"></i>
                        <i class="fa fa-eye-slash" aria-hidden="true" id="nshow_eye"></i>
                    </span>
                </div>
            </div>

            <label for="c_npassword" class="form-label">Confirm New Password</label>
            <div class="input-group">
                <input type="password" name="confirm_newpassword" id="c_npassword" class="form-control" placeholder="Cofirm New Password" required aria-label="cpassword" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="c_npassword_show_hide();">
                        <i class="fa fa-eye d-none" aria-hidden="true" id="c_nhide_eye"></i>
                        <i class="fa fa-eye-slash" aria-hidden="true" id="c_nshow_eye"></i>
                    </span>  
                </div>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>

            <button type="submit" class="change">Change</button>

        </form>
    </div>


    <!--script (function for password visibility)-->
    <script>
        function opassword_show_hide() {

            var x = document.getElementById("opassword");
            var show_eye = document.getElementById("oshow_eye");
            var hide_eye = document.getElementById("ohide_eye");
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
        function npassword_show_hide() {

            var x = document.getElementById("npassword");
            var show_eye = document.getElementById("nshow_eye");
            var hide_eye = document.getElementById("nhide_eye");
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
        function c_npassword_show_hide() {

            var x = document.getElementById("c_npassword");
            var show_eye = document.getElementById("c_nshow_eye");
            var hide_eye = document.getElementById("c_nhide_eye");
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   
    <script src="../js/main.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>