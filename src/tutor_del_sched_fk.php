<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM tutor_schedule WHERE id='$id'";

        mysqli_query($conn, $sql);

        header("location: tutor_delete.php?id=$id");

    
?>