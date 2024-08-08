<?php
if (isset($_POST['add_cat'])) {
    $send_name = sanitizeInput($_POST['send_name']);
    $send_phone = sanitizeInput($_POST['send_phone']);
    $send_address = sanitizeInput($_POST['send_address']);
    $send_id_type = sanitizeInput($_POST['send_id_type']);
    $send_id_number = sanitizeInput($_POST['send_id_number']);
    $send_purpose = sanitizeInput($_POST['send_purpose']);
    $recieve_name = sanitizeInput($_POST['recieve_name']);
    $recieve_country = sanitizeInput($_POST['recieve_country']);
    $mtcn = sanitizeInput($_POST['mtcn']);
    $date = sanitizeInput($_POST['date']);
    $time = sanitizeInput($_POST['time']);
    $amount_send = sanitizeInput($_POST['amount_send']);
    $fee = sanitizeInput($_POST['fee']);
    $total = sanitizeInput($_POST['total']);
    $exchange_rate = sanitizeInput($_POST['exchange_rate']);
    $payout_amount = sanitizeInput($_POST['payout_amount']);
    $agent_details = sanitizeInput($_POST['agent_details']);
    $formerror = [];

    if (empty($formerror)) {
        // get the last request number 
        $stmt = $connect->prepare("SELECT * FROM new_western_accounts WHERE mtcn = ?");
        $stmt->execute(array($mtcn));
        $count_mtcn = $stmt->rowCount();
        if ($count_mtcn > 0) {
            $formerror[] = 'رقم التحويل mtcn متواجد من قبل ';
        }
        $stmt = $connect->prepare("INSERT INTO new_western_accounts (send_name,send_phone,send_address,send_id_type,send_id_number,send_purpose,recieve_name,recieve_country,mtcn,date,time,amount_send ,fee,total,exchange_rate,payout_amount,agent_details)
        VALUES(:zsend_name,:zsend_phone,:zsend_address,:zsend_id_type,:zsend_id_number,
        :zsend_purpose,:zrecieve_name,:zrecieve_country,:zmtcn,:zdate,:ztime,:zamount_send ,:zfee,:ztotal,:zexchange_rate,:zpayout_amount,:zagent_details)
        ");
        $stmt->execute(array(
            "zsend_name" => $send_name,
            "zsend_phone" => $send_phone,
            "zsend_address" => $send_address,
            "zsend_id_type" => $send_id_type,
            "zsend_id_number" => $send_id_number,
            "zsend_purpose" => $send_purpose,
            "zrecieve_name" => $recieve_name,
            "zrecieve_country" => $recieve_country,
            "zmtcn" => $mtcn,
            "zdate" => $date,
            "ztime" => $time,
            "zamount_send" => $amount_send,
            "zfee" => $fee,
            "ztotal" => $total,
            "zexchange_rate" => $exchange_rate,
            "zpayout_amount" => $payout_amount,
            "zagent_details"=>$agent_details,

        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=western&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=western&page=report');
        exit();
    }
}
