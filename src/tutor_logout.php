<?php

    session_start();

    if(isset($_SESSION['unique_id'])){

        include 'connection.php';

        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        if(isset($logout_id)){
            $tutor_status = "Offline now";

            $sql = mysqli_query($conn, "UPDATE tutors SET tutor_status = '{$tutor_status}' WHERE unique_id={$_GET['logout_id']}");

            if($sql){
                session_unset();
                session_destroy();
                header("location: tutor_login.php");
            }
        }else{
            header("location: students.php");
        }
    }else{  
        header("location: tutor_login.php");
    }

?>