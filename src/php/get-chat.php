<?php 
    session_start();

    include 'connection.php';

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM students WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: student_login.php?restricted-std");

    }

    if(isset($_SESSION['unique_id'])){

        $outgoing_id = $_SESSION['unique_id']; //logged in user's (sender) unique_id is equals to outgoing_id

        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); //receiver's unique_id is equals to incoming_id

        $output = "";

        //selecting all chat that matched to incoming_msg_id and outgoing_msg_id
        $sql = "SELECT * FROM messages
                LEFT JOIN students ON students.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) > 0) {

            while($row = mysqli_fetch_assoc($query)) {

                if($row['outgoing_msg_id'] === $outgoing_id) {//msg sender
                    
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';

                }else { //msg receiver

                    $output .= '<div class="chat incoming">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }
            }
        }else {

            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        
        echo $output;

    }else{

        header("location: ../student_login.php");
    }


    
?>