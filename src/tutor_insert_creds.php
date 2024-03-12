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
            
            $imageName = $_FILES["cred_pic"]["name"];
            $imageSize = $_FILES["cred_pic"]["size"];
            $tmpName = $_FILES["cred_pic"]["tmp_name"];

            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));

            if (!in_array($imageExtension, $validImageExtension)){

                echo
                    "
                    <script>
                    alert('Invalid Image Extension');
                    document.location.href = '../LearnSystem';
                    </script>
                    ";

            }elseif ($imageSize > 1200000){

                echo
                    "
                    <script>
                    alert('Image Size Is Too Large');
                    document.location.href = '../LearnSystem';
                    </script>
                    ";

            }else{
            
                $query = "INSERT INTO credibility (sender_id, receiver_id, notif_subj, notif_msg, cred_pic, req_status) VALUES ('$sender_id', '1', '$notif_subj', '$notif_msg', '$imageName', ' $req_status')";

                $success_query = mysqli_query($conn, $query);

                move_uploaded_file($tmpName, 'credentials/' . $imageName);

                if($success_query) {


                    header("Location: tutor_verification.php?success=Credential Sent Successfully");

                }else {

                    header("Location: tutor_verification.php?error=Cannot Send Credential");
                    
                }
                
            }
        }
?>