<?php

    include("connection.php");

        session_start();

        //insert_creds.php
        if(isset($_POST["request"])) {

            //$id = $_SESSION['id'];

            $sender_id = $_SESSION['id'];
            $notif_subj = $_POST['notif_subj'];
            $notif_msg = $_POST['notif_msg'];
            // $cred_pic = $_POST['cred_pic'];

            $req_status = 0;
            
            $extension = array('jpg', 'jpeg', 'png', 'pdf');  

            foreach ($_FILES["cred_pic"]["tmp_name"] as $key => $value) {
                $filename = $_FILES["cred_pic"]["name"][$key];
                $filesize = $_FILES["cred_pic"]["size"][$key];
                $filename_tmp = $_FILES["cred_pic"]["tmp_name"][$key];
                
                $ext = pathinfo($filename, PATHINFO_EXTENSION);   

                $finalimg ='';
                if (in_array($ext,  $extension)) {

                    if (!file_exists('credentials/' . $filename)) {

                        move_uploaded_file($filename_tmp, 'credentials/' . $filename);
                        $finalimg = $filename;

                    }else {

                        $filename = str_replace('.','-',basename($filename, $ext));
                        $newfilename = $filename.time().".". $ext;
                        move_uploaded_file($filename_tmp, 'credentials/' . $newfilename);
                        $finalimg = $newfilename;

                    }  
                
                $query = "INSERT INTO credibility (sender_id, receiver_id, notif_subj, notif_msg, cred_pic, req_status) VALUES ('$sender_id', '1', '$notif_subj', '$notif_msg', '$finalimg', ' $req_status')";

                $success_query = mysqli_query($conn, $query);
    
                
                    if($success_query) {
        
        
                        header("Location: tutor_verification.php?success=Credential Sent Successfully");
        
                    }else {
        
                            header("Location: tutor_verification.php?error=Cannot Send Credential");
                            
                    }
                    

                }elseif ($filesize > 1200000){

                    echo
                        "
                        <script>
                        alert('Image Size Is Too Large');
                        document.location.href = 'tutor_verification.php';
                        </script>
                        ";
    
                }else {

                    echo
                    "
                    <script>
                    alert('Invalid Image Extension');
                    document.location.href = 'tutor_verification.php';
                    </script>
                    ";
                    
                }
            }
        }
?>