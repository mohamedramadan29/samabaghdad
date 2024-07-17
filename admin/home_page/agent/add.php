<?php
if (isset($_POST['add_cat'])) {
    $name = sanitizeInput($_POST['name']);
    $address = sanitizeInput($_POST['address']);
    $address_info = sanitizeInput($_POST['address_info']);
    $phone = sanitizeInput($_POST['phone']);

    $formerror = [];
    if (empty($name)) {
        $formerror[] = ' من فضلك ادخل اسم الوكيل   ';
    }
    $stmt = $connect->prepare("SELECT * FROM agents WHERE name=?");
    $stmt->execute(array($name));
    $acount_num = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الوكيل موجود من قبل من فضللك ادخل اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO agents (address,name,address_info,phone)
        VALUES(:zaddress,:zname,:zaddress_info,:zphone)
        ");
        $stmt->execute(array(
            "zaddress" => $address,
            "zname" => $name,
            "zaddress_info" => $address_info,
            "zphone" => $phone
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=home_page/agent&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/agent&page=report');
        exit();
    }
}
