<?php

    include 'connection.php';

    session_start();

    error_reporting(0);

    //to get the updated profile
    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tutors WHERE id = $id"));
    
    $profile = $rowimg['profile'];

    if (isset($_POST['check'])) {
        $income = $_POST['income'];
        $fee = $_POST['fee'];

        $toPay = $income * $fee;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Information</title>

    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href ="css/payment.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/payment.css">

    <!-- script for payment -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
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
                        <a class="nav-link opt" href="pending.php">
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

                    <button type="button" class="btn dt-admin" data-bs-toggle="dropdown" aria-expanded="false" id="<?php echo $id; ?>" onclick="load_unseen_notification(view)">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill count-admin" style="border-radius:10px; background: #2d5f74;"></span>
                        <i class="fa-solid fa-shield"></i>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end dd-admin">

                    </ul>
                </div>  

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
                            <li><a class="dropdown-item" href="tutor_verification.php">Verification</a></li>
                            <hr>
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
    <div class="container">

        <p class="acc-text">Payment Information</p>
            
        <form method='POST' action=''>
            <div class='mb-3'>
                <label for='Income' class='col-form-label'>Income:</label>
                <input type='text' name='income' class='form-control' id='income' value='<?php echo $income;?>'>
            </div>  
            <div class='mb-3'>
                <label for='fee' class='col-form-label'>Fee:</label>
                <input type='text' name='fee' class='form-control' id='fee' value='0.10' readonly>
            </div>  
            <input type='submit' class='btn btn-success check' name='check' id='check' value='Check Amount'>

            <div class="mb-3">
                <label for="toPay" class="col-form-label">Amount to Pay:</label>
                <input type="text" name="toPay" class="form-control" id="toPay" value="<?php echo $toPay; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="options" class="col-form-label">Payment Options:</label> <br>
                <img src="assets/gcash.png" alt="" class="gcash" data-bs-toggle="modal" data-bs-target="#gcashModal<?php echo $_GET['notif_id'];?>">
                <img src="assets/maya.jpg" alt="" class="maya" data-bs-toggle="modal" data-bs-target="#mayaModal<?php echo $_GET['notif_id'];?>">
            </div>
        </form> 
    </div>
    
    <?php
        $query=mysqli_query($conn, "SELECT * FROM `notification` WHERE notif_tid = '$id' ") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){
    ?>
    <!--GCash Modal -->
    <div class="modal fade" id="gcashModal<?php echo $_GET['notif_id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header g">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pay via </h1>
                <img src="assets/gcash.png" alt="">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="gresponse">
                    
                </div>
                <form action="pay_gcash.php?id=<?php echo $fetch['notif_tid'];?>" method="post" id="gform">
                    <div class="mb-3">
                        <label for='number' class='col-form-label'>GCash Number:</label>
                        <input type="text" name="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for='mpin' class='col-form-label'>GCash MPIN:</label>
                        <input type="password" name="mpin"  class="form-control">
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        Enter your GCash number and MPIN to pay.
                    </div>

                    <input type="hidden" name="tutor_id" id="tutor_id" value="<?php echo $fetch['notif_tid']; ?>">
                    <input type="hidden" name="income"  id="income" value="<?php echo $income;?>">
                    <input type="hidden" name="toPay"  id="toPay" value="<?php echo $toPay; ?>">

                    <input type="submit" class="btn btn-primary paygcash" id="paygcash" name="pay" value="Confirm Payment">
                </form>
                <form action="req_action.php?id=<?php echo $_GET['notif_id']; ?>" method="post">
                    <input type="hidden" name="appid" value="<?php echo $_GET['notif_id']; ?> ">
                    <input type="hidden" name="notif_tid" value="<?php echo $fetch['notif_tid']; ?>" >
                    <input type="hidden" name="notif_sid" value="<?php echo $fetch['notif_sid']; ?> ">
                    <input type="hidden" name="notif_subj" value="<?php echo $_SESSION['firstname']. " " . $_SESSION['lastname']; ?> ">
                    <input type="hidden" name="notif_msgc" value="Session Complete.">  
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn gc" name="complete" value="Confirm Payment">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Maya Modal -->
    <div class="modal fade" id="mayaModal<?php echo $_GET['notif_id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header m">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pay via </h1>
                <img src="assets/maya.jpg" alt="">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="response">
                    
                </div>
                <form action="pay_maya.php?id=<?php echo $fetch['notif_tid'];?>" method="POST" id="form">
                    <div class="mb-3">
                        <label for='number' class='col-form-label'>Maya Number:</label>
                        <input type="text" name="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for='pass' class='col-form-label'>Password:</label>
                        <input type="password" name="pass"  class="form-control">
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        Enter your Maya number and Password to pay.
                    </div>

                    <input type="hidden" name="tutor_id" id="tutor_id" value="<?php echo $_GET['notif_tid']; ?>">
                    <input type="hidden" name="income"  id="income" value="<?php echo $income;?>">
                    <input type="hidden" name="toPay"  id="toPay" value="<?php echo $toPay; ?>">

                    <input type="submit" class="btn btn-primary pay" id="paymaya" name="pay" value="Confirm Payment">
                </form>
                <form action="req_action.php?id=<?php echo $_GET['notif_id']; ?>" method="post">
                    <input type="hidden" name="appid" value="<?php echo $_GET['notif_id']; ?> ">
                    <input type="hidden" name="notif_tid" value="<?php echo $fetch['notif_tid']; ?>" >
                    <input type="hidden" name="notif_sid" value="<?php echo $fetch['notif_sid']; ?> ">
                    <input type="hidden" name="notif_subj" value="<?php echo $_SESSION['firstname']. " " . $_SESSION['lastname']; ?> ">
                    <input type="hidden" name="notif_msgc" value="Session Complete.">           
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn ma" name="complete" value="Complete Session">
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
            }
        }
    ?>

    <!-- script for gcash pay -->
    <script>
        $("#paygcash").click( function() {
        
            $.post( $("#gform").attr("action"),
                    $("#gform :input").serializeArray(),
                function(info) {
            
                    $("#gresponse").empty();
                    $("#gresponse").html(info);
                
                });
            
            $("#gform").submit( function() {
                return false;  
            });
        });
        
    </script>

    <!-- script for maya pay -->
    <script>
        $("#paymaya").click( function() {
        
            $.post( $("#form").attr("action"),
                    $("#form :input").serializeArray(),
                function(info) {
            
                    $("#response").empty();
                    $("#response").html(info);
                
                });
            
            $("#form").submit( function() {
                return false;  
            });
        });
        
    </script>

    <!--script for notif from student-->
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

    <!--script for notif from admin-->
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "tutor_fetch.php",
                    method: "POST",
                    data: {
                        view: view,
                        ids: "<?php echo $id; ?>"
                    },
                    dataType: "json",
                    success: function(data) {
                        // .dd class ng <ul> dropdown
                        $('.dd-admin').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.count-admin').html(data.unseen_notification);
                        }
                    }
                });
            }
            load_unseen_notification();

            // .dt class ng button
            $(document).on('click', '.dt-admin', function() {
                $('.count-admin').html('');
                load_unseen_notification('yes');
            });
            setInterval(function() {
                load_unseen_notification();;
            }, 500);
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>