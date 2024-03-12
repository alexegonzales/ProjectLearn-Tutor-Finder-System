<?php

    include ("../connection.php");

    $sql = "DELETE FROM credibility WHERE cred_id='" . $_GET["cred_id"] . "' ";

    $run = mysqli_query($conn,$sql);

    if($run == true){
                
        // echo "<script> 
        //         alert('User Deleted');
        //         window.open('pending.php','_self');
        //     </script>";

        header("Location: verification_request.php?removed=Request Removed");
    }else{
        echo "<script> 
        alert('Failed to delete');
        </script>";
    }

    mysqli_close($conn);

?>