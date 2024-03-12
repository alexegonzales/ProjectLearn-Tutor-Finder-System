<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM notification WHERE notif_sid ='$id' OR notif_tid='$id'";

        mysqli_query($conn, $sql);

        header("location: tutor_del_msg_fk.php?id=$id");

    
?>