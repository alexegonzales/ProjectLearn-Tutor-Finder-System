<?php

    include ("../connection.php");

    if (isset($_POST['edit'])) {

        $id = $_POST['id'];
      
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        $update = mysqli_query($conn, "UPDATE students SET firstname='$fname', lastname='$lname', email='$email', contact='$contact' WHERE id='$id' ");   

        if($update) {

            header("Location: student_table.php?success=Student Profile Updated.");

        }else {

            echo "<script> 
			alert('Failed To Update');
			</script>";

        }
    }

    if (isset($_POST['editTutor'])) {

        $id = $_POST['id'];
      
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        $update = mysqli_query($conn, "UPDATE tutors SET firstname='$fname', lastname='$lname', email='$email', contact='$contact' WHERE id='$id' ");   

        if($update) {

            header("Location: tutor_table.php?success=Tutor Profile Updated.");

        }else {

            echo "<script> 
			alert('Failed To Update');
			</script>";

        }
    }
?>