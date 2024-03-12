<?php

    session_start();

    include 'connection.php';

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-tch");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />

    <!-- <link rel="stylesheet" href="css/list.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/list.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
        <header>
            <?php

                $student_id = mysqli_real_escape_string($conn, $_GET['id']);

                $sql = mysqli_query($conn, "SELECT * FROM students WHERE unique_id = {$student_id}");

                    if(mysqli_num_rows($sql) > 0){

                        $row = mysqli_fetch_assoc($sql);

                    }
            ?>    
        
            <a href="students.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

            <img src="uploads/<?php echo $row['profile'] ?>"alt="">

            <div class="details">
                <span><?php echo $row['firstname']. " " . $row['lastname'] ?></span>
                <p><?php echo $row['student_status']; ?></p>
            </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
            <input type="hidden" class="s_id" name="s_id" value="<?php echo $row['id']; ?>"> <!--receiver id-->
            <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden> <!--sender unique_id-->
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $student_id; ?>" hidden> <!--receiver unique_id-->
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>
        </section>
    </div>

    <script src="js/students_chat.js"></script>
    
</body>
</html>