<?php

    session_start();

    if(isset($_SESSION['unique_id'])){

        include 'connection.php';

        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        if(isset($logout_id)){
            $student_status = "Offline now";

            $sql = mysqli_query($conn, "UPDATE students SET student_status = '{$student_status}' WHERE unique_id={$_GET['logout_id']}");

            if($sql){
                session_unset();
                session_destroy();
                header("location: student_login.php");
            }
        }else{
            header("location: users.php");
        }
    }else{  
        header("location: student_login.php");
    }

    //session_destroy();
    
    //header("Location: student_login.php");

?>