<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM student_schedule WHERE id='$id'";

        mysqli_query($conn, $sql);

        header("location: student_delete.php?id=$id");

    
?>