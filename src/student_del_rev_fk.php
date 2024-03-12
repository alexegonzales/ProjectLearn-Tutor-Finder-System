<?php
    session_start();

    include 'connection.php';

    if (isset($_GET['deleteStudent'])) {

        $id = $_GET['id'];

        $sql = "DELETE FROM review WHERE rev_sender_id='$id'";

        mysqli_query($conn, $sql);

        header("location: student_del_notif_fk.php?id=$id");

    }
?>