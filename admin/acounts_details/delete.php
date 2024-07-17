<?php
if (isset($_GET['request_id']) && is_numeric($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    $stmt = $connect->prepare("SELECT * FROM account_details WHERE id = ?");
    $stmt->execute(array($request_id));
    $account_data = $stmt->fetch();
    $account_id = $account_data['account_id'];
    $stmt = $connect->prepare('DELETE FROM account_details WHERE id=?');
    $stmt->execute([$request_id]);
    if ($stmt) {
        $_SESSION['success_message'] = "تم الحذف بنجاح"; 
        header('Location:main?dir=acounts_details&page=report&account_id='.$account_id);
        exit(); // Terminate the script after redirecting
    }
}
