<?php

    include 'connection.php';

    session_start();

    $outgoing_id = $_SESSION['unique_id'];

    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM tutors WHERE NOT unique_id = {$outgoing_id} AND (firstname LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%' OR email LIKE '%{$searchTerm}%') ";

    $output = "";

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){

        include "data.php";

    }else{

        $output .= 'No user found related to your search term';
    }

    echo $output;
?>