<?php

    require_once('connection.php');

	if(!isset($_GET['id'])){
	    echo "<script> alert('Undefined Schedule ID.'); location.replace('tutor_page.php') </script>";
	    $conn->close();
	    exit;
	}
 
	$delete = $conn->query("DELETE FROM `tutor_schedule` where title = '{$_GET['id']}'");
	if($delete){
	    echo "<script> alert('Event has deleted successfully.'); location.replace('tutor_page.php') </script>";
	}else{
	    echo "<pre>";
	    echo "An Error occured.<br>";
	    echo "Error: ".$conn->error."<br>";
	    echo "SQL: ".$sql."<br>";
	    echo "</pre>";
	}
	$conn->close();

?>
