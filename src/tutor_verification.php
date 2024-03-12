<?php

    include 'connection.php';

    session_start();

    $id = $_SESSION['id'];

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutor Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="css/cred.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/cred.css">

  </head>
  <body>

    <div class="container">
            
        <a href="tutor_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

        <p class="acc-text">Account Verification</p>
            
        <form action="upload_creds.php" method="post" id="cred" class="cred" enctype="multipart/form-data">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>  

            <label for="">Upload either of the credentials listed here</label>
            <input type="hidden" name="sender_id" value="<?php echo $id; ?>"> <!--sender id-->
            <input type="hidden" name="notif_subj" id="notif_subj" value="<?php echo $_SESSION['firstname']. " " . $_SESSION['lastname'];?>">  
            <input type="hidden" name="notif_msg" id="notif_msg" value="Account verfication request.">
            <div id="cred_pic1" class="form-text">Professional Certification/Licensure</div>
            <input type="file" name="cred_pic[]"  id="cred_pic1" class="form-control up" accept=".jpg, .jpeg, .png">
            <div id="cred_pic2" class="form-text">Certificate of Degree</div>
            <input type="file" name="cred_pic[]"  id="cred_pic2" class="form-control up" accept=".jpg, .jpeg, .png">
            <div id="cred_pic3" class="form-text">Certificate of Training</div>
            <input type="file" name="cred_pic[]"  id="cred_pic3" class="form-control up" accept=".jpg, .jpeg, .png">
            <div id="cred_pic4" class="form-text">Project Samples</div>
            <input type="file" name="cred_pic[]"  id="cred_pic4" class="form-control up" accept=".jpg, .jpeg, .png">

            <input type="submit" name="request" id="request" class="btn btn-req" value="Send Credentials" />    
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!--script for notif-->
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "student_fetch.php",
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