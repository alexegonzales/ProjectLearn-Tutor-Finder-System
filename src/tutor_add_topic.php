<?php

    include 'connection.php';

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-tch");
    }

    //to get the updated profile
    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tutors WHERE id = $id"));
    
    $profile = $rowimg['profile'];

    if(isset($_POST['submit'])) {

        $id = $_SESSION['id'];
        $topic_name = $_POST['topic_name'];
        $tutor_name = $_POST['tutor_name'];

        $add_topic = mysqli_query($conn, "INSERT INTO topics (tutor_id, topic_name, tutor_name)
                                        VALUES ('$id', '$topic_name', '$tutor_name')");

            header("Location: tutor_add_topic.php?success=Topic added successfully");
            exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Topic</title>

    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href ="css/add_subj.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/add_subj.css">

    
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
                        <a class="nav-link opt active" href="tutor_add_topic.php">
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
        <p class="acc-text">Add Topic</p>

        <form action="" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>  

            <input type="hidden" name="tutor_id" value="<?php echo $id; ?>">

            <input type="hidden" name="tutor_name" value="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>">

            <input type="text" name="topic_name" placeholder="Enter a topic">

            <input type="submit" class="submit" name="submit">
        </form>
    </div>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>