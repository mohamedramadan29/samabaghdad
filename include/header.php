<?php
$stmt = $connect->prepare("SELECT * FROM index_page");
$stmt->execute();
$indexdata = $stmt->fetch();
$main_color = $indexdata['main_color'];
$website_title = $indexdata['hero_title'];
$logo = $indexdata['logo'];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> <?php echo $website_title ?> </title>
    <meta name="description" content=" المنصة الرسمية لحجز الدولار للمسافرين  ">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <meta name="keywords" content="  <?php echo $website_title ?>  ">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image" href="admin/home_page/uploads/<?php echo $logo; ?>"> 
    <link rel="icon" href="admin/home_page/uploads/<?php echo $logo; ?>" sizes="32x32" />
    <link rel="icon" href="admin/home_page/uploads/<?php echo $logo; ?>" sizes="192x192" />
    <link rel="apple-touch-icon" href="admin/home_page/uploads/<?php echo $logo; ?>" />
    <meta name="msapplication-TileImage" content="admin/home_page/uploads/<?php echo $logo; ?>" />
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo $css ?>main.css">

    <style>
        *{
            --main-color: <?php echo $main_color; ?>
        }
    </style>
</head>


<body>