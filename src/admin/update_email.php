<?php

include ("../connection.php");

session_start();

$id = $_SESSION['admin_id'];
$email = $_POST['email'];

if(isset($_POST['update'])) {

    $update = "UPDATE admin SET email='$email' WHERE admin_id='$id'"; 

    $result = mysqli_query($conn, $update);

    if($result) {

        //header("Location: admin_login.php?Your email has been changed successfully");

        echo "<script> window.location.href = 'admin_login.php'; alert('Your email has been changed successfully.');</script>";

    }else {

        header("Location: admin_acc_sett.php?error=Error in updating email.");

        exit();
    }
}
?>