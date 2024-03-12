<?php
    session_start();

    include 'connection.php';

        $id = $_GET['id'];

        $sql = "DELETE FROM messages WHERE smsg_id ='$id' OR tmsg_id='$id'";

        mysqli_query($conn, $sql);

        header("location: tutor_del_sched_fk.php?id=$id");

    
?>