<?php

    session_start();

    include 'connection.php';

    $outgoing_id = $_SESSION['unique_id'];

    //select query to get the list of students
    $sql = "SELECT * FROM students
    LEFT JOIN messages 
    ON students.id = messages.smsg_id
    GROUP BY students.id
    ORDER BY messages.datetime DESC";

    $query = mysqli_query($conn, $sql);

    $output = "";

        if(mysqli_num_rows($query) == 0){

            $output .= "No users are available to chat";

        }elseif(mysqli_num_rows($query) > 0){

            include 'students_data.php';

        }

    echo $output;
?>
