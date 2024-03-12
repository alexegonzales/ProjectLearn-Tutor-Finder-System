<?php

    session_start();

    include 'connection.php';

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-tch");
        //echo "<script>alert('Restricted Page!'); window.location.href='tutor_login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students' List</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <!-- <link rel="stylesheet" href="css/list.css"> -->

    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/list.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="users">
        <header>
            <div class="content">
                <a href="tutor_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <?php

                     //select the the data of the current logged user using session
                    $sql = mysqli_query($conn, "SELECT * FROM tutors WHERE id = {$_SESSION['id']}");

                        if(mysqli_num_rows($sql) > 0){
                            
                        $row = mysqli_fetch_assoc($sql);
                        
                    }
                ?>
                <img src="uploads/<?php echo $row['profile'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['firstname']. " " . $row['lastname'] ?></span>
                    <p><?php echo $row['tutor_status']; ?></p>
                </div>
            </div> 
        </header>
        <div class="search">
            <span class="text">Select a student to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
    
        </div>
        </section>
    </div>

    <script src="js/students.js"></script>
</body>
</html>