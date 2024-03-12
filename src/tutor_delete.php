<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM tutors WHERE id='$id'";

        mysqli_query($conn, $sql);

        echo "<script> window.location.href = 'tutor_login.php'; alert('Account has been deleted.');</script>";
    
?>