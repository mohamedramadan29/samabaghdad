<?php
if (isset($_POST['edit_cat'])) {
    $service_id = $_POST['service_id'];
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_name = str_replace(' ', '-', $image_name);
        $image_temp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_uploaded = time() . '_' . $image_name;
        $upload_path = 'western_page/wester_box/uploads/' . $image_uploaded;
        move_uploaded_file($image_temp, $upload_path);
 
    } else {
        $image_uploaded = '';
    }


    $formerror = [];
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE wester_box SET title=?,description=? WHERE id = ? ");
        $stmt->execute(array($title, $description, $service_id));
        if (!empty($_FILES['image']['name'])) {
            $stmt = $connect->prepare("UPDATE wester_box SET image=? WHERE id = ? ");
            $stmt->execute(array($image_uploaded, $service_id));
        }
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=western_page/wester_box&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=western_page/wester_box&page=report');
        exit();
    }
}
