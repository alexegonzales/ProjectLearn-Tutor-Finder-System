<?php

    include ("../connection.php");

    session_start();

    if(isset($_POST['sort'])){

		$req_status=$_POST['verification_status'];
		
		$query=mysqli_query($conn, "SELECT * FROM `students` WHERE `verification_status`='$req_status'") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){

                // echo"<tr><td>".$fetch['req_status']."</td><td>".$fetch['id']."</td></tr>";
                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['firstname'] .' ' .$fetch['lastname']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['reg_date']))."</td>
                    <td>";
                        if($fetch['verification_status'] == 'Verified') {
                            echo "<span class='badge badge-success app'>Verified</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        } else {
                            echo "<span class='badge badge-danger rej'>Declined</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }

                $cnt++;	
                    "</td>
                </tr>";
            } 
        }else {
            
            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }

	} else if(isset($_POST['reset'])) {
        
        $query=mysqli_query($conn, "SELECT * FROM `students` WHERE verification_status = 'Verified' OR verification_status = 'Declined' ORDER BY id") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {    

            while($fetch=mysqli_fetch_array($query)){

                // echo"<tr><td>".$fetch['req_status']."</td><td>".$fetch['id']."</td></tr>";
                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['firstname'] .' ' .$fetch['lastname']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['reg_date']))."</td>
                    <td>";
                        if($fetch['verification_status'] == 'Verified') {
                            echo "<span class='badge badge-success app'>Verified</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        } else {
                            echo "<span class='badge badge-danger rej'>Declined</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }

                $cnt++;	
                    "</td>
                </tr>";
            }
        }else {
            
            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }
    
    } else {

        $query=mysqli_query($conn, "SELECT * FROM `students` WHERE verification_status = 'Verified' OR verification_status = 'Declined' ORDER BY id") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {    

            while($fetch=mysqli_fetch_array($query)){

                // echo"<tr><td>".$fetch['req_status']."</td><td>".$fetch['id']."</td></tr>";
                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['firstname'] .' ' .$fetch['lastname']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['reg_date']))."</td>
                    <td>";
                        if($fetch['verification_status'] == 'Verified') {
                            echo "<span class='badge badge-success app'>Verified</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        } else {
                            echo "<span class='badge badge-danger rej'>Declined</span>
                            <td><a href='admin_remove_req.php?cred_id=".$fetch['id']."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }

                $cnt++;	
            
                    "</td>
                </tr>";  
            }  
        }else {
            
            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }
    }
    
?>