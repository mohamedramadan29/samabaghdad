<?php
if (isset($_POST['add_cat'])) {
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    // // update section two background
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_name = str_replace(' ', '-', $image_name);
        $image_temp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_uploaded = time() . '_' . $image_name;
        $upload_path = 'home_page/services/uploads/' . $image_uploaded;
        move_uploaded_file($image_temp, $upload_path);
 
    }
    $formerror = [];
    if (empty($title)) {
        $formerror[] = ' من فضلك ادخل اسم الخدمة   ';
    }
    $stmt = $connect->prepare("SELECT * FROM services WHERE title=?");
    $stmt->execute(array($title));
    $acount_num = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الخدمة موجود من قبل من فضللك ادخل اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO services (title,description,image)
        VALUES(:ztitle,:zdescription,:zimage)
        ");
        $stmt->execute(array(
            "ztitle" => $title,
            "zdescription" => $description,
            "zimage" => $image_uploaded
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=home_page/services&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/services&page=report');
        exit();
    }
}
