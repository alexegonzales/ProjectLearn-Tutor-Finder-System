<?php
     
    include 'connection.php';

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM students WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: student_login.php?restricted-std");

    }

    //to get the updated profile
    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id = $id"));

    $profile = $rowimg['profile'];
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href ="css/sched_style.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/sched_style.css">

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="css/main.min.css">

    <script src="js/jquery-3.6.0.min.js"></script>

    <script src="js/main.min.js"></script>

    <title>Student Schedule</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />
  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
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
                    <a class="nav-link opt" href="student_page.php">
                        <i class="fa-solid fa-house"></i>
                        <label>home</label>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link opt active" href="student_schedule.php">
                        <i class="fa-regular fa-calendar"></i>
                        <label>schedule</label>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link opt" href="users.php">
                        <i class="fa-solid fa-message"></i>
                        <label>chat</label>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link opt" href="enrolled_list.php">
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <label>rate tutors</label>
                    </a>
                </li>
            </ul>
            <div class="dropdown" style="margin-right: 1rem;">
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
                            <li><a class="dropdown-item" href="student_acc_sett.php">Account settings</a></li>
                            <li><a class="dropdown-item" href="student_change_pass.php">Change password</a></li>
                            <hr>
                            <?php

                                include 'connection.php';

                                $sql = mysqli_query($conn, "SELECT * FROM students WHERE unique_id = {$_SESSION['unique_id']}");

                                    if(mysqli_num_rows($sql) > 0){
                                        
                                    $row = mysqli_fetch_assoc($sql);
                                    
                                }
                            ?>
                            <li><a class="dropdown-item" href="student_logout.php?logout_id=<?php echo $row['unique_id']?>" style="color: red;">Log out</a></li>
                        </ul>
                    </div>
                </span>
            </div>
        </div>
    </nav>

    <div class="container py-4" id="page-container" style="background: white;">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient text-dark">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="student_save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-sm rounded-0" style="background: #fff; border: solid 1px;" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-sm rounded-0" style="background: #fff; border: solid 1px;  color: red;" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-label">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-label">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-label">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-label">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <?php 
        $schedules = $conn->query("SELECT * FROM `student_schedule` WHERE id=$id");
        $sched_res = [];
        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $sched_res[$row['title']] = $row;
        }
        ?>
    <?php 
        if(isset($conn)) $conn->close();
    ?>

    <script>
            var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>

    <script src="js/sched.js"></script>

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
