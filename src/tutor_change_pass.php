<?php

    include 'connection.php';

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-std");

    }

    //Funtion to change password
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

                header("Location: tutor_change_pass.php?error=Invalid new password");
    
            }elseif ($newpass !== $c_newpass) {

                header("Location: tutor_change_pass.php?error=The confirmation password does not match");
                exit();

            }else {

            // hashing the password
            $hash_oldpass = md5($oldpass);
            $hash_newpass = md5($newpass);

            $id = $_SESSION['id'];

            $sql = "SELECT password FROM tutors WHERE id='$id' AND password='$hash_oldpass'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                
                $sql_2 = "UPDATE tutors SET password='$hash_newpass'WHERE id='$id'";

                mysqli_query($conn, $sql_2);

                header("Location: tutor_login.php?Your password has been changed successfully");
                exit();

            }else {
                header("Location: tutor_change_pass.php?error=Old password does not match");
                exit();
            }

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <!-- <link rel="stylesheet" type="text/css" href ="css/cpass.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/cpass.css">

    <title>Tutor Change Password</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />
</head>
<body>
    <div class="container">
        <form action="" method="post">

            <a href="tutor_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

            <p class="change_pass-text">Change Password</p>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

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

            <button type="submit">Change</button>

        </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>