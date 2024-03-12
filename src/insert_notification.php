<?php

    include("connection.php");

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    //insert.php
    if(isset($_POST["enroll"])) {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '2022projectlearn@gmail.com'; // gmail
        $mail->Password = 'oyydimkxbsrtrrzs';//gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('2022projectlearn@gmail.com'); //gmail

        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);

        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];

        $mail->send();

        //for notif inside the system
        $notif_sid = $_SESSION['id'];
        $notif_tid = $_POST['notif_tid'];
        $notif_subj = $_POST['notif_subj'];
        $notif_msg = $_POST['notif_msg'];

        $req_status = 0;
         
        $query = "INSERT INTO notification(notif_sid, notif_tid, notif_subj, notif_msg, req_status) VALUES ('$notif_sid','$notif_tid', '$notif_subj', '$notif_msg', ' $req_status')";

        $success_query = mysqli_query($conn, $query);
       
        if($success_query) {

              echo "<script> window.location.href = 'student_page.php'; alert('Request Sent Successfully.');</script>";

        }else {

          echo "<script> window.location.href = 'student_page.php'; alert('Something went wrong.');</script>";
          
        }
        //header("location: student_page.php");


    }
?>