<?php

    include ("../../connection.php");

    session_start();

    if(isset($_POST['sort'])){

        $tutor_col = $_POST['tutor_columns'];
        
        $query=mysqli_query($conn, "SELECT * FROM `tutors` WHERE `verification_status`='$req_status'") or die(mysqli_error());

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