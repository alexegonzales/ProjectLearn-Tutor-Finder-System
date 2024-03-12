<?php

    include ("../connection.php");

    $tutor_id = $_GET['id'];

    $sql = mysqli_query($conn, "SELECT * FROM tutors WHERE id = '$tutor_id' ");

    if(mysqli_num_rows($sql) > 0){
        
        $row = mysqli_fetch_assoc($sql);
        $directory = ("../credentials/");
        $pdf = $row['credential'];
        $file = $directory.$pdf;
    }

   
    header('Content-type:application/pdf');
    header('Contetnt-Description:inline;filename="' .$file .'"');
    header('Content-Transfer-Encoding:binary');
    header('Accept-ranges:bytes');
    @readfile($file);

?>  