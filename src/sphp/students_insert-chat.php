<?php 
    session_start();

    if(isset($_SESSION['unique_id'])){ //unique_id of the logged in user

        include 'connection.php';

        $s_id = mysqli_real_escape_string($conn, $_POST['s_id']); //receiver's id 

        $outgoing_id = $_SESSION['unique_id']; //logged in user's (sender) unique_id is equals to outgoing_id

        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); //receiver's unique_id is equals to incoming_id

        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message)){

            $sql = mysqli_query($conn, "INSERT INTO messages (tmsg_id, smsg_id, incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ('{$_SESSION['id']}', '{$s_id}', '{$incoming_id}', '{$outgoing_id}', '{$message}')") or die();
        }

    }else{

        header("location: ../tutor_login.php");
    }
    
?>