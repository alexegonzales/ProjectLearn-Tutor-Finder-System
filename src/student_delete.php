<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM students WHERE id='$id'";

        mysqli_query($conn, $sql);

        echo "<script> window.location.href = 'student_login.php'; alert('Account has been deleted.');</script>";

        //header("location: student_login.php");

    
?>