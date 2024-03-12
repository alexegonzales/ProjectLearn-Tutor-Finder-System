<?php

    session_start();

    include 'connection.php';

    $outgoing_id = $_SESSION['unique_id'];

    //select query to get the list of tutors
    $sql = "SELECT * FROM tutors
    LEFT JOIN messages 
    ON tutors.id = messages.tmsg_id
    GROUP BY tutors.id
    ORDER BY messages.datetime DESC";

    $query = mysqli_query($conn, $sql);

    $output = "";

        if(mysqli_num_rows($query) == 0){

            $output .= "No users are available to chat";

        }elseif(mysqli_num_rows($query) > 0){

            include 'data.php';

        }

    echo $output;
?>

