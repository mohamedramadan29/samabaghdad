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
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE credits_section_four SET title=? WHERE id = ? ");
        $stmt->execute(array($title, $service_id));
        if (!empty($_FILES['image']['name'])) {
            $stmt = $connect->prepare("UPDATE credits_section_four SET image=? WHERE id = ? ");
            $stmt->execute(array($image_uploaded, $service_id));
        }
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=home_page/credits&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=home_page/credits&page=report');
        exit();
    }
}
