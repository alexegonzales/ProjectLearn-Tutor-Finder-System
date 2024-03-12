<?php
    include 'connection.php';

    $tutor_id = $_GET['id'];
    $income = $_POST['income'];
    $toPay = $_POST['toPay'];

    $trans_id = rand(time(), 10000000);
    $pay_opt = 'GCash';

    $insert = "INSERT INTO payment (tutor_id, transaction_id, payment_option, income, toPay) VALUES ('$tutor_id', '$trans_id', '$pay_opt', '$income', '$toPay')";

    $run = mysqli_query($conn, $insert);

    if($run == true) {

        echo '<p class="success">Transaction Complete!</p>';

    } else {
        
        echo '<p class="error">Failed to Process!</p>';
    }

?>