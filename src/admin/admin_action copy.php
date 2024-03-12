<?php

    include ("../connection.php");

    if (isset($_POST['verify'])){

		$appid = $_POST['appid'];
		$sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];
        $notif_subj = $_POST['notif_subj'];
        $notif_msgv = $_POST['notif_msgv'];
		
		$insert = "INSERT INTO credibility (sender_id, receiver_id, notif_subj, notif_msg) VALUES ('$receiver_id', '$sender_id', '$notif_subj', '$notif_msgv')";

		$insert_run = mysqli_query($conn, $insert);

		$sql = "UPDATE credibility SET req_status=1 WHERE cred_id = '$appid'";

		$run = mysqli_query($conn,$sql);

		if($run == true){
			
			// echo "<script> 
			// 		alert('Application Approved');
			// 		window.open('pending.php','_self');
			// 	  </script>";
			
			header("Location: pending_req.php?success=Account Verified");
		}else{
			echo "<script> 
			alert('Failed To Verify');
			</script>";
		}
	}

	if (isset($_POST['decline'])) {

		$appid = $_POST['appid'];
		$sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];
        $notif_subj = $_POST['notif_subj'];
		$notif_msgd = $_POST['notif_msgd'];

		$insert = "INSERT INTO credibility  (sender_id, receiver_id, notif_subj, notif_msg) VALUES ('$receiver_id', '$sender_id', '$notif_subj', '$notif_msgd')";

		$insert_run = mysqli_query($conn, $insert);

		$sql = "UPDATE credibility SET req_status=2 WHERE cred_id = '$appid'";

		$run = mysqli_query($conn,$sql);

		if($run == true){
			
			// echo "<script> 
			// 		alert('Application Rejected');
			// 		window.open('pending.php','_self');
			// 	  </script>";

			header("Location: pending_req.php?error=Account Declined");
		}else{
			echo "<script> 
			alert('Failed To Decline');
			</script>";
		}
	}

?>          