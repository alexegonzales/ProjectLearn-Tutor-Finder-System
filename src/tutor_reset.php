<?php 
	//database connection
	include 'connection.php';

	//session start
	session_start();
	
	mysqli_query($conn, "UPDATE tutors SET lock_date = '', status = '3' WHERE email = '$_SESSION[email]'");
 ?>