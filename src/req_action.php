<?php
    include 'connection.php';

    if (isset($_POST['approve'])){

		$appid = $_POST['appid'];
		$notif_sid = $_POST['notif_sid'];
        $notif_tid = $_POST['notif_tid'];
        $notif_subj = $_POST['notif_subj'];
        $notif_msga = $_POST['notif_msga'];

		$insert = "INSERT INTO notification (notif_sid, notif_tid, notif_subj, notif_msg) VALUES ('$notif_tid','$notif_sid', '$notif_subj', '$notif_msga')";

		$insert_run = mysqli_query($conn, $insert);

		$sql = "UPDATE notification SET req_status='1' WHERE notif_id = '$appid'";

		$run = mysqli_query($conn,$sql);

		if($run == true){
			
			header("Location: pending.php?success=Request Approved");
		}else{
			echo "<script> 
			alert('Failed To Approved');
			</script>";
		}
	}

	if (isset($_POST['reject'])) {

		$appid = $_POST['appid'];
		$notif_sid = $_POST['notif_sid'];
        $notif_tid = $_POST['notif_tid'];
        $notif_subj = $_POST['notif_subj'];
		$notif_msgr = $_POST['notif_msgr'];

		$insert = "INSERT INTO notification (notif_sid, notif_tid, notif_subj, notif_msg) VALUES ('$notif_tid','$notif_sid', '$notif_subj', '$notif_msgr')";

		$insert_run = mysqli_query($conn, $insert);

		$sql = "UPDATE notification SET req_status='2' WHERE notif_id = '$appid'";

		$run = mysqli_query($conn,$sql);

		if($run == true){

			header("Location: pending.php?error=Request Rejected");
		}else{
			echo "<script> 
			alert('Failed To Reject');
			</script>";
		}
	}

	if (isset($_POST['complete'])) {

		$appid = $_POST['appid'];
		$notif_sid = $_POST['notif_sid'];
        $notif_tid = $_POST['notif_tid'];
        $notif_subj = $_POST['notif_subj'];
		$notif_msgr = $_POST['notif_msgc'];


		$insert = "INSERT INTO notification (notif_sid, notif_tid, notif_subj, notif_msg) VALUES ('$notif_tid','$notif_sid', '$notif_subj', '$notif_msgr')";

		$insert_run = mysqli_query($conn, $insert);

		$sql = "UPDATE notification SET req_status='3' WHERE notif_id = '$appid'";

		$run = mysqli_query($conn,$sql);

		if($run == true){

			header("Location: pending.php?complete=Session Complete");
		}else{
			echo "<script> 
			alert('Session cannot be complete');
			</script>";
		}
	}

	// $income = $_POST['income'];
    // $fee = $_POST['fee'];

    // $toPay = $income * $fee;
        
    // echo  '
	// <div class="mb-3">
    //     <label for="toPay" class="col-form-label">Amount to Pay:</label>
    // 	<input type="text" name="toPay" class="form-control" id="toPay" value="' .$toPay .'">
    // </div>
	// <div class="mb-3">
	// 	<label for="options" class="col-form-label">Payment Options:</label> <br>
	// 	<img src="assets/gcash.png" alt="" class="gcash" data-bs-toggle="modal" data-bs-target="#gcashModal">
	// 	<img src="assets/maya.jpg" alt="" class="maya" data-bs-toggle="modal" data-bs-target="#mayaModal">
	// </div>';
