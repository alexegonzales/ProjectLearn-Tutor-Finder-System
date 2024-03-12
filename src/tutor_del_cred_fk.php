<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM credibility WHERE sender_id = '$id' OR receiver_id='$id'";

        mysqli_query($conn, $sql);

        header("location: tutor_del_notif_fk.php?id=$id");

?>