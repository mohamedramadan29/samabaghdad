<?php
if (isset($_GET['request_id']) && is_numeric($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    $stmt = $connect->prepare('DELETE FROM requests WHERE id=?');
    $stmt->execute([$request_id]);
    if ($stmt) {
        $_SESSION['success_message'] = "تم الحذف بنجاح";
        header('Location: main?dir=requests&page=report');
        exit(); // Terminate the script after redirecting
    }
}
