<?php
if (isset($_POST['edit_cat'])) {
    $service_id = $_POST['service_id'];
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);



    $formerror = [];
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE western_payment_methods SET title=?,description=? WHERE id = ? ");
        $stmt->execute(array($title, $description, $service_id));
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=western_page/westen_payment_method&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=western_page/westen_payment_method&page=report');
        exit();
    }
}
