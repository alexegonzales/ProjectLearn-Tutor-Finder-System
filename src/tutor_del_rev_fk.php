<?php
    session_start();

    include 'connection.php';

    if (isset($_GET['deleteTutor'])) {

        $id = $_GET['id'];

        $sql = "DELETE FROM review WHERE rev_receiver_id = '$id'";

        mysqli_query($conn, $sql);

        header("location: tutor_del_top_fk.php?id=$id");

    }

?>