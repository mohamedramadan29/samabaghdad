<?php
if (isset($_POST['add_cat'])) {
    $name = sanitizeInput($_POST['name']);
    $address = sanitizeInput($_POST['address']);
    $phone = sanitizeInput($_POST['phone']);

    $formerror = [];
    if (empty($name)) {
        $formerror[] = ' من فضلك ادخل اسم الفرع    ';
    }
    $stmt = $connect->prepare("SELECT * FROM branches WHERE name=?");
    $stmt->execute(array($name));
    $acount_num = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الفرع موجود من قبل من فضللك ادخل اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO branches (name,address,phone)
        VALUES(:zname,:zaddress,:zphone)
        ");
        $stmt->execute(array(
            "zname" => $name,
            "zaddress" => $address,
            "zphone" => $phone
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=home_page/branches&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/branches&page=report');
        exit();
    }
}
