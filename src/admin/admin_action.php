<?php

    include ("../connection.php");

    if (isset($_POST['verify'])){

		$tutor_id = $_POST['id'];

		$sql = "UPDATE tutors SET verification_status = 'Verified' WHERE id = '$tutor_id'";

		$run = mysqli_query($conn,$sql);

		if($run == true){
			
			header("Location: pending_req.php?success=Account Verified");
		}else{
			echo "<script> 
			alert('Failed To Verify');
			</script>";
		}
	}

	if (isset($_POST['decline'])) {

		$tutor_id = $_POST['id'];

		$sql = "UPDATE tutors SET verification_status = 'Declined' WHERE id = '$tutor_id'";

		$run = mysqli_query($conn,$sql);

		if($run == true){

			header("Location: pending_req.php?error=Account Declined");
		}else{
			echo "<script> 
			alert('Failed To Decline');
			</script>";
		}
	}

?>          