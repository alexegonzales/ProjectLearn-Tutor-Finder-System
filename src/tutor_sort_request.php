<?php

    include 'connection.php';

    if(isset($_POST['sort'])) {

        $req_status=$_POST['req_status'];

        $query=mysqli_query($conn, "SELECT * FROM `notification` WHERE `req_status`='$req_status' AND notif_tid = '$id' ") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['notif_subj']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['req_date']))."</td>
                    <td>";
                        if($fetch['req_status'] == 0) {
                            echo "<span class='badge badge-secondary pen'>Pending</span>
                    </td>
                    <td>
                    <form method='POST' action='req_action.php?id='".$fetch['notif_id'] ."'>
                        <input type='hidden' name='appid' value='" .$fetch['notif_id'] ."'>
                        <input type='hidden' name='notif_tid' value='" .$fetch['notif_tid'] ."'>
                        <input type='hidden' name='notif_sid' value='" .$fetch['notif_sid'] ."'>
                        <input type='hidden' name='notif_subj' value='" .$_SESSION['firstname']. " " . $_SESSION['lastname'] ."'>
                        <input type='hidden' name='notif_msga' value='Your request has been approved.'>
                        <input type='hidden' name='notif_msgr' value='Your request has been rejected.'>
                        <input type='submit' class='btn btn-sm btn-success' name='approve' value='Approve'>
                        <input type='submit' class='btn btn-sm btn-danger' name='reject' value='Reject'>
                    </form>
                    </td>";
                        } else if($fetch['req_status'] == 1) {

                            echo "<span class='badge badge-success app'>Approved</span>
                            <td>
                                <a href='tutor_payment_information.php?notif_id=" .$fetch['notif_id']."'>
                                    <button type='button' class='btn btn-sm btn-primary'>Complete</button>
                                </a>
                            </td>";
                        
                        } else if($fetch['req_status'] == 2) {

                            echo "<span class='badge badge-danger rej'>Rejected</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";

                        } else {
                            echo "<span class='badge com'>Completed</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }
                $cnt++;	
            }

        } else {

            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }

    } elseif (isset($_POST['reset'])) {

        $query=mysqli_query($conn, "SELECT * FROM `notification` WHERE notif_tid = '$id' ") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['notif_subj']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['req_date']))."</td>
                    <td>";
                        if($fetch['req_status'] == 0) {
                            echo "<span class='badge badge-secondary pen'>Pending</span>
                    </td>
                    <td>
                    <form method='POST' action='req_action.php?id='".$fetch['notif_id'] ."'>
                        <input type='hidden' name='appid' value='" .$fetch['notif_id'] ."'>
                        <input type='hidden' name='notif_tid' value='" .$fetch['notif_tid'] ."'>
                        <input type='hidden' name='notif_sid' value='" .$fetch['notif_sid'] ."'>
                        <input type='hidden' name='notif_subj' value='" .$_SESSION['firstname']. " " . $_SESSION['lastname'] ."'>
                        <input type='hidden' name='notif_msga' value='Your request has been approved.'>
                        <input type='hidden' name='notif_msgr' value='Your request has been rejected.'>
                        <input type='submit' class='btn btn-sm btn-success' name='approve' value='Approve'>
                        <input type='submit' class='btn btn-sm btn-danger' name='reject' value='Reject'>
                    </form>
                    </td>";
                        } else if($fetch['req_status'] == 1) {

                            echo "<span class='badge badge-success app'>Approved</span>
                            <td>
                                <a href='tutor_payment_information.php?notif_id=" .$fetch['notif_id']."'>
                                    <button type='button' class='btn btn-sm btn-primary'>Complete</button>
                                </a>
                            </td>";
                        
                        } else if($fetch['req_status'] == 2) {

                            echo "<span class='badge badge-danger rej'>Rejected</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";

                        } else {
                            echo "<span class='badge com'>Completed</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }
                $cnt++;	
            }

        } else {

            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }

    } else {

        $query=mysqli_query($conn, "SELECT * FROM `notification` WHERE notif_tid = '$id' ") or die(mysqli_error());

        $cnt = 1;

        $check_que = mysqli_num_rows($query) > 0;

        if ($check_que) {

            while($fetch=mysqli_fetch_array($query)){

                echo"
                <tr>
                    <td>".$cnt."</td>
                    <td>".$fetch['notif_subj']."</td>
                    <td>".date('Y/m/d h:i:s A', strtotime($fetch['req_date']))."</td>
                    <td>";
                        if($fetch['req_status'] == 0) {
                            echo "<span class='badge badge-secondary pen'>Pending</span>
                    </td>
                    <td>
                        <form method='POST' action='req_action.php?id='".$fetch['notif_id'] ."'>
                            <input type='hidden' name='appid' value='" .$fetch['notif_id'] ."'>
                            <input type='hidden' name='notif_tid' value='" .$fetch['notif_tid'] ."'>
                            <input type='hidden' name='notif_sid' value='" .$fetch['notif_sid'] ."'>
                            <input type='hidden' name='notif_subj' value='" .$_SESSION['firstname']. " " . $_SESSION['lastname'] ."'>
                            <input type='hidden' name='notif_msga' value='Your request has been approved.'>
                            <input type='hidden' name='notif_msgr' value='Your request has been rejected.'>
                            <input type='submit' class='btn btn-sm btn-success' name='approve' value='Approve'>
                            <input type='submit' class='btn btn-sm btn-danger' name='reject' value='Reject'>
                        </form>
                    </td>";
                        } else if($fetch['req_status'] == 1) { 

                            echo "<span class='badge badge-success app'>Approved</span>
                            <td>
                                <a href='tutor_payment_information.php?notif_id=" .$fetch['notif_id']."'>
                                    <button type='button' class='btn btn-sm btn-primary'>Complete</button>
                                </a>
                            </td>";
                        
                        } else if($fetch['req_status'] == 2) {

                            echo "<span class='badge badge-danger rej'>Rejected</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";

                        } else {
                            echo "<span class='badge com'>Completed</span>
                            <td><a href='remove_req.php?notif_id=" .$fetch['notif_id'] ."'><button class='btn btn-sm btn-dark remove'>Remove</button></a></td>";
                        }
                $cnt++;	
            }

        } else {

            echo "
            <table class='new-tbl'>
                <thead class='no-req'>
                    <th>No Request Yet</th>
                </thead>
            </table>";
        }
    }
    
?>




