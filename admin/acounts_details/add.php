<?php
if (isset($_POST['add_cat'])) {
    $all_price = $_POST['total_price'];
    $account_id  = $_POST['account_id'];
    $account_number = sanitizeInput($_POST['account_number']);
    $price_amount = sanitizeInput($_POST['price_amount']);
    $price_date = sanitizeInput($_POST['price_date']);
    echo $all_price;
    echo "</br>";
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
    echo $total_price;
    $total_price = $total_price + $price_amount;
    if ($total_price   > $all_price) {
        $formerror[] = ' من فضلك رقم الايداع تخطي الرقم المطلوب  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO account_details (account_id,price_amount,price_date)
        VALUES(:zaccount_id,:zprice_amount,:zprice_date)
        ");
        $stmt->execute(array(
            "zaccount_id" => $account_id,
            "zprice_amount" => $price_amount,
            "zprice_date" => $price_date
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
     header('Location:main?dir=acounts_details&page=report&account_id=' . $account_id);
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=acounts_details&page=report&account_id=' . $account_id);
        exit();
    }
}
