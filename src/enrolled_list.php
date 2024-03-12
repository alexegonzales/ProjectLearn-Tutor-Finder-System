<?php

    include 'connection.php';

    session_start();

    //to get the updated profile
    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id = $id"));

    $profile = $rowimg['profile'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Enrolled List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!--for copy icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <!-- <link rel="stylesheet" type="text/css" href ="css/tpage_style.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/tpage_style.css">
    
    <script src="js/notif.js"></script>

  </head>
  <body>

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
                        <a class="nav-link opt" href="student_schedule.php">
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
                        <a class="nav-link opt active" href="enrolled_list.php">
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
                            <button class="fullname"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></button>
                            <img src="uploads/<?php echo $profile; ?>" class="profile-pic" alt="">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end justify-content-center shadow animated--grow-in">
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
    <div class="container">
        <div class="row mt-4">
            <nav class="navbar bg-transparent mb-2 navbar-light">
                <div class="container-fluid">
                    <h2 style="text-align: left;">Tutor List</h2>
                </div>
            </nav>                                
            <?php
                //Query to get the teachers' information

                $select = "SELECT tutors.*, GROUP_CONCAT(topics.topic_name SEPARATOR ', ') 
                AS topic_name  
                FROM topics, tutors
                LEFT JOIN notification
                ON tutors.id = notification.notif_tid
                WHERE notification.req_status = 1 AND notification.notif_sid = '$id' AND tutors.id = topics.tutor_id GROUP BY id";

                $select_run = mysqli_query($conn, $select);

                $check_students = mysqli_num_rows($select_run) > 0;

                if($check_students) {

                    while($rows = mysqli_fetch_array($select_run)) {

                        ?>  
    
                            <div class="col-md-4">
                                <div class="card" id="card">
                                    <div class="card-header">
                                        <div>
                                            <img src="uploads/<?php echo $rows['profile']?>" class="card-img-top" alt="Profile Picture">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="lbl">Name:</td>
                                                <td align="justify" class="info"><?php echo $rows['firstname'] . " " . $rows['lastname'];?></td>
                                            </tr>
                                            <tr>
                                                <td class="lbl">Topic/s:</td>
                                                <td align="justify" class="info"><?php echo $rows['topic_name'];?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="justify" class="info"><div class="btn-view position-absolute bottom-0 end-0 translate-middle"><button type="button" class="btn btn-modal" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rows['id']?>">view more</button></div></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal fade" id="exampleModal<?php echo $rows['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <img src="uploads/<?php echo $rows['profile']?>" alt="">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $rows['firstname'] . " " . $rows['lastname'];?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td class="lbl">Email:</td>
                                                            <td align="justify" class="info">
                                                                <div class="copy-text">
                                                                    <input type="text" class="copy-text-input" name="email" id="email" value="<?php echo $rows['email']; ?>" readonly>
                                                                    <button type="button" class="copy-text-button">
                                                                        <span class="material-icons">content_copy</span>
                                                                    </button>              
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="lbl">Contact:</td>
                                                            <td align="justify" class="info"><?php echo $rows['contact'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="lbl">Sex:</td>
                                                            <td align="justify" class="info"><?php echo $rows['sex']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="lbl">Educational Attainment:</td>
                                                            <td align="justify" class="info"><?php echo $rows['education']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="lbl">Bio:</td>
                                                            <td align="justify" class="info"><?php echo $rows['bio'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <a href="rate_tutors.php?id=<?php echo $rows['id']; ?>">
                                                                    <input type="button" name="rate" id="rate" class="btn btn-info" value="Rate" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                    }

                }else {

                    echo '
                    <table class="new-tbl">
                    <thead class="no-req">
                        <th >No Tutor Yet</th>
                    </thead>
                
                    </table>';
                }
            ?>
        </div>
    </div>

    <!--script for copy btn-->
    <script>
        document.querySelectorAll(".copy-text").forEach((copyLinkParent) => {
            const inputField = copyLinkParent.querySelector(".copy-text-input");
            const copyButton = copyLinkParent.querySelector(".copy-text-button");
            const text = inputField.value;

            inputField.addEventListener("focus", () => inputField.select());

            copyButton.addEventListener("click", () => {
                inputField.select();
                navigator.clipboard.writeText(text);

                inputField.value = "Copied!";
                setTimeout(() => (inputField.value = text), 2000);
            });
        });

    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="js/users.js"></script>

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

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>