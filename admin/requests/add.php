<?php
if (isset($_POST['add_cat'])) {
    $name = sanitizeInput($_POST['name']);
    $price_request = sanitizeInput($_POST['price_request']);
    $city = sanitizeInput($_POST['city']);
    $phone = sanitizeInput($_POST['phone']);
    $request_order = sanitizeInput($_POST['request_order']);
    $note = sanitizeInput($_POST['note']);
    $random_number = mt_rand(10000, 99999);
    $current_time = microtime(true);
    $unique_number = $current_time . $random_number;
    $final_number = substr($unique_number, -5);

    $formerror = [];
    if (empty($name)) {
        $formerror[] = ' من فضلك ادخل الاسم  ';
    }
    if (empty($formerror)) {
        // get the last request number 
        $stmt = $connect->prepare("SELECT * FROM requests ORDER BY id DESC");
        $stmt->execute();
        $last_request_data = $stmt->fetch();
        $last_request_number = $last_request_data['request_number'];
        $stmt = $connect->prepare("INSERT INTO requests (name,price_request,city,phone,request_order,request_number,note)
        VALUES(:zname,:zprice_request,:zcity,:zphone,:zrequest_order,:zrequest_number,:znote)
        ");
        $stmt->execute(array(
            "zname" => $name,
            "zprice_request" => $price_request,
            "zcity" => $city,
            "zphone" => $phone,
            "zrequest_order" => $request_order,
            //"zrequest_number" => "00" . $last_request_number + 1,
            "zrequest_number" => $final_number,
            "znote" => $note,
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=requests&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=categories&page=report');
        exit();
    }
}
