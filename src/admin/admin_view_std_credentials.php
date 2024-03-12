<?php

    include ("../connection.php");

    $student_id = $_GET['id'];

    $sql = mysqli_query($conn, "SELECT * FROM students WHERE id = '$student_id' ");

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