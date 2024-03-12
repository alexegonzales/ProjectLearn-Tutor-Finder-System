<?php

    require_once('connection.php');

    session_start();

    //for tutors
    if($_SERVER['REQUEST_METHOD'] !='POST'){
        echo "<script> alert('Error: No data to save.'); location.replace('tutor_page.php') </script>";
        $conn->close();
        exit;
    }
    extract($_POST);

    $allday = isset($allday);

    if(empty($id)){
        $sql = "INSERT INTO `tutor_schedule` (`id`,`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('{$_SESSION['id']}','$title','$description','$start_datetime','$end_datetime')";
    }else{
        $sql = "UPDATE `tutor_schedule` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `title` = '{$id}'";
    }
    $save = $conn->query($sql);

    if($save){
        echo "<script> alert('Schedule Successfully Saved.'); location.replace('tutor_page.php') </script>";
    }else{
        echo "<pre>";
        echo "An Error occurred.<br>";
        echo "Error: ".$conn->error."<br>";
        echo "SQL: ".$sql."<br>";
        echo "</pre>";
    }
    $conn->close();

?>