<?php
if (isset($_POST['add_cat'])) {
    $title = sanitizeInput($_POST['title']);
    // // update section two background
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_name = str_replace(' ', '-', $image_name);
        $image_temp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_uploaded = time() . '_' . $image_name;
        $upload_path = 'home_page/credits/uploads/' . $image_uploaded;
        move_uploaded_file($image_temp, $upload_path);

        // تحقق من نوع الصورة
        if (exif_imagetype($upload_path) === IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($upload_path);
        } elseif (exif_imagetype($upload_path) === IMAGETYPE_PNG) {
            $image = imagecreatefrompng($upload_path);
        }

        if (isset($image) && $image !== false) {
            $webp_path = 'home_page/credits/uploads/' . pathinfo($image_uploaded, PATHINFO_FILENAME) . '.webp';
            // حفظ الصورة بتنسيق WebP
            imagewebp($image, $webp_path);
            // تدمير الصورة
            imagedestroy($image);
            // تحديث مسار الصورة المرفوعة لنسخة WebP
            $image_uploaded = pathinfo($image_uploaded, PATHINFO_FILENAME) . '.webp';
        } else {
            echo 'لا يمكن فتح الصورة.';
        }
    }
    $formerror = [];
    if (empty($title)) {
        $formerror[] = ' من فضلك ادخل اسم الخدمة   ';
    }
    $stmt = $connect->prepare("SELECT * FROM services_section_four WHERE title=?");
    $stmt->execute(array($title));
    $acount_num = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الخدمة موجود من قبل من فضللك ادخل اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO credits_section_four (title,image)
        VALUES(:ztitle,:zimage)
        ");
        $stmt->execute(array(
            "ztitle" => $title,
            "zimage" => $image_uploaded
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=home_page/credits&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/credits&page=report');
        exit();
    }
}
