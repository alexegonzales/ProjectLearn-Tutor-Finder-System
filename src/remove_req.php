<?php

    include 'connection.php';

    $sql = "DELETE FROM notification WHERE notif_id='" . $_GET["notif_id"] . "'";

    $run = mysqli_query($conn,$sql);

    if($run == true){

        header("Location: pending.php?removed=Request Removed");
    }else{
        echo "<script> 
        alert('Failed to delete');
        </script>";
    }

    mysqli_close($conn);

?>