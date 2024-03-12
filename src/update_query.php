<?php

   //update queries
   include 'connection.php';

   session_start();

   //for tutors
   if(isset($_POST['updateTutor'])) {
         
    $id = $_POST['id'];
      
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $education = $_POST['education'];
    $bio = $_POST['bio'];

    $update = mysqli_query($conn, "UPDATE tutors SET firstname='$fname', lastname='$lname', email='$email', contact='$contact', sex='$sex', education='$education', bio='$bio' WHERE id='$id'") or die(mysqli_error());   
       
    header("location: tutor_acc_sett.php");

 }


      //for students
     if(isset($_POST['updateStudent'])) {
         
      $id = $_POST['id'];
      
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $sex = $_POST['sex'];

   
      $update = mysqli_query($conn, "UPDATE students SET firstname='$fname', lastname='$lname', email='$email', contact='$contact', sex='$sex' WHERE id='$id'") or die(mysqli_error());   

      header("location: student_acc_sett.php"); 

   }
?>