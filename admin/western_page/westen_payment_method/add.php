<?php
if (isset($_POST['add_cat'])) {
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
 
    $formerror = [];
    if (empty($title)) {
        $formerror[] = ' من فضلك ادخل اسم الخدمة   ';
    }
    $stmt = $connect->prepare("SELECT * FROM western_payment_methods WHERE title=?");
    $stmt->execute(array($title));
    $acount_num = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الخدمة موجود من قبل من فضللك ادخل اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO western_payment_methods (title,description)
        VALUES(:ztitle,:zdescription)
        ");
        $stmt->execute(array(
            "ztitle" => $title,
            "zdescription" => $description, 
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=western_page/westen_payment_method&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=western_page/westen_payment_method&page=report');
        exit();
    }
}
