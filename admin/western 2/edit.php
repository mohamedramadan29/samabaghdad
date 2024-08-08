<?php
if (isset($_POST['edit_cat'])) {
    $western_id = $_POST['western_id'];
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
        $stmt = $connect->prepare("UPDATE new_western_accounts SET send_name=?,send_phone=?,send_address=?,send_id_type=?,send_id_number=?,send_purpose=?,recieve_name=?,recieve_country=?,mtcn=?,date=?,time=?,amount_send=? ,fee=?,total=?,exchange_rate=?,payout_amount=?,agent_details=? WHERE id = ? ");
        $stmt->execute(array($send_name,$send_phone,$send_address,$send_id_type,$send_id_number,$send_purpose,$recieve_name,$recieve_country,$mtcn,$date,$time,$amount_send ,$fee,$total,$exchange_rate,$payout_amount,$agent_details,$western_id));
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=western&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=western&page=report');
        exit();
    }
}
