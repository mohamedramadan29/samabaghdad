<?php
if (isset($_POST['edit_cat'])) {
    $account_details_id = $_POST['account_details_id'];
    $all_price = $_POST['total_price'];
    $account_id  = $_POST['account_id'];
    $account_number = sanitizeInput($_POST['account_number']);
    $price_amount = sanitizeInput($_POST['price_amount']);
    $price_date = sanitizeInput($_POST['price_date']);

    $formerror = [];
    if (empty($price_amount)) {
        $formerror[] = ' من فضلك ادخل قيمة الايداع  ';
    }
    $stmt = $connect->prepare("SELECT * FROM account_details WHERE account_id=?");
    $stmt->execute(array($account_id));
    $account_rows = $stmt->fetchAll();

    $total_price = 0;

    foreach ($account_rows as $row) {
        $total_price += $row['price_amount'];
    }
    $total_price = $total_price + $price_amount;
    if ($total_price > $all_price) {
        $formerror[] = ' من فضلك رقم الايداع تخطي الرقم المطلوب  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE account_details SET price_amount=?,price_date=? WHERE id = ?");
        $stmt->execute(array(
            $price_amount, $price_date, $account_details_id
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت التعديل بنجاح  ";
            header('Location:main?dir=acounts_details&page=report&account_id=' . $account_id);
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=acounts_details&page=report&account_id=' . $account_id);
        exit();
    }
}
