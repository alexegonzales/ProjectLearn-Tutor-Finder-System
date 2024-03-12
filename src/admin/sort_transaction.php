<?php
    include ("../connection.php");

    if(isset($_POST['sort'])){

		$payment_option=$_POST['payment_option'];
		
		$query=mysqli_query($conn, "SELECT * FROM `payment` WHERE `payment_option`='$payment_option'") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['tutor_id']."</td>
                    <td>".$fetch['transaction_id']."</td>
                    <td>".$fetch['payment_option']."</td>
                    <td>".number_format($fetch['income'],2)."</td>
                    <td>".number_format($fetch['toPay'],2)."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['pay_date']))."</td>";

                $cnt++;	
                    "</td>
                </tr>";
            } 
        } else {

            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Transaction Yet</th>
                </thead>
            </table>";
        }

	} else if(isset($_POST['reset'])) {
        
        $query=mysqli_query($conn, "SELECT * FROM `payment` ORDER BY payment_id") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {    

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['tutor_id']."</td>
                    <td>".$fetch['transaction_id']."</td>
                    <td>".$fetch['payment_option']."</td>
                    <td>".number_format($fetch['income'],2)."</td>
                    <td>".number_format($fetch['toPay'],2)."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['pay_date']))."</td>";

                $cnt++;	
                    "</td>
                </tr>";
            }
        } else {

            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Transaction Yet</th>
                </thead>
            </table>";
        }
    
    }  else {

        $query=mysqli_query($conn, "SELECT * FROM `payment` ORDER BY payment_id") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {    

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['tutor_id']."</td>
                    <td>".$fetch['transaction_id']."</td>
                    <td>".$fetch['payment_option']."</td>
                    <td>".number_format($fetch['income'],2)."</td>
                    <td>".number_format($fetch['toPay'],2)."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['pay_date']))."</td>";

                $cnt++;	
                    "</td>
                </tr>";
            }  
        }else {
            
            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Transaction Yet</th>
                </thead>
            </table>";
        }
    }

?>