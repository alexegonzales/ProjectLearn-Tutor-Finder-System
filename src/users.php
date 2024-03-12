<?php

    session_start();

    include 'connection.php';

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM students WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: student_login.php?restricted-std");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutors' List</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="users">
        <header>
            <div class="content">
                <a href="student_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <?php

                    //select the the data of the current logged user using session
                    $sql = mysqli_query($conn, "SELECT * FROM students WHERE id = {$_SESSION['id']}");

                        if(mysqli_num_rows($sql) > 0){
                            
                        $row = mysqli_fetch_assoc($sql);
                        
                    }
                ?>
                <img src="uploads/<?php echo $row['profile'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['firstname']. " " . $row['lastname'] ?></span>
                    <p><?php echo $row['student_status']; ?></p>
                </div>
            </div> 
        </header>
        <div class="search">
            <span class="text">Select a tutor to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
    
        </div>
        </section>
    </div>

    <!-- <script src="js/users.js"></script> -->
    <script src="https://alexe-ctrl.github.io/js/users.js"></script>
</body>
</html>