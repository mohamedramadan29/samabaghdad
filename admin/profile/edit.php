<?php
if (isset($_POST['edit_cat'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $formerror = [];
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE admins SET username=?,email=?,phone=?,password=?");
        $stmt->execute(array($username,$email,$phone,$password));
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=profile&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=profile&page=report');
        exit();
    }
}
