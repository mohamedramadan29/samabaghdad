<?php
if (isset($_POST['edit_cat'])) {
    $agent_id = $_POST['agent_id'];
    $name = sanitizeInput($_POST['name']);
    $address = sanitizeInput($_POST['address']);
    $phone = sanitizeInput($_POST['phone']);
    $formerror = [];
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE branches SET name=?,address=?,phone=? WHERE id = ? ");
        $stmt->execute(array($name, $address, $phone, $agent_id));
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=home_page/branches&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/branches&page=report');
        exit();
    }
}
