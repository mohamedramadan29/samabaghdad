<?php
if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $connect->prepare('DELETE FROM  western WHERE id=?');
    $stmt->execute([$order_id]);
    if ($stmt) {
        $_SESSION['success_message'] = "تم الحذف بنجاح";
        header('Location: main?dir=wester_orders&page=report');
        exit(); // Terminate the script after redirecting
    }
}
