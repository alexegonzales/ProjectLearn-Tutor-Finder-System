<?php

    include 'connection.php';

    //ajax ids
    $id_view = $_POST['view'];
    $student_id = $_POST['ids'];

    //updating status when notification is clicked/read
    if(isset($_POST["view"])) {

        if($_POST["view"] != '') {

            $update_query = "UPDATE notification SET notif_status = 1 WHERE notif_tid = $student_id AND notif_status = 0";

            mysqli_query($conn, $update_query);

        }

        //query for showing the notif msg
        $query = "SELECT * FROM notification WHERE notif_tid = '$student_id'  ORDER BY req_date DESC LIMIT 5";

        $result = mysqli_query($conn, $query);

        $output = '';
        
        if(mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {

                $output .= '
                <li style = "padding-left: 7px;">
                    <a href="users.php" style="text-decoration: none; font-size: 15px; color: #000;">
                        <b>'.$row["notif_subj"].'</b><br />
                        <p><em>'.$row["notif_msg"].'</em></p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                ';
            }
        } else {

            $output .= '<li><a href="#" class="notif-text" style="text-decoration: none; color: #6c757d;">No Notification Found</a></li>';

        }
        

        //query for showing status count in a specific user
        $sel_count = "SELECT * FROM notification WHERE notif_tid = '$student_id' AND notif_status = 0";

        $count_res = mysqli_query($conn, $sel_count);

        $count = mysqli_num_rows($count_res);

        $data = array(
            'notification'   => $output,
            'unseen_notification' => $count
            );
                
            echo json_encode($data);
    }
?>