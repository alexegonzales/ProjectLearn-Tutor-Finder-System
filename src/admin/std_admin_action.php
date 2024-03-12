<?php

    include ("../connection.php");

    if (isset($_POST['verify'])){

		$student_id = $_POST['id'];

		$sql = "UPDATE students SET verification_status = 'Verified' WHERE id = '$student_id'";

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

		$student_id = $_POST['id'];

		$sql = "UPDATE students SET verification_status = 'Declined' WHERE id = '$student_id'";

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