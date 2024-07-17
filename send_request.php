<?php
ob_start();
session_start();
include 'init.php';
if (isset($_REQUEST['send_request'])) {
    $name = sanitizeInput($_POST['name']);
    $price_request = sanitizeInput($_POST['price_request']);
    $city = sanitizeInput($_POST['city']);
    $phone = sanitizeInput($_POST['phone']);
    $request_order = sanitizeInput($_POST['request_order']);
    $formerror = [];
    if (empty($name) || empty($price_request) || empty($city) || empty($phone) || empty($request_order)) {
        $formerror[] = 'من فضلك اكمل جميع البيانات';
    }
    if (empty($formerror)) {
        $random_number = mt_rand(10000, 99999);
        $current_time = microtime(true);
        $unique_number = $current_time . $random_number;
        $final_number = substr($unique_number, -5);

        session_destroy();
        $stmt = $connect->prepare("INSERT INTO requests (name,price_request,city,phone,request_order,request_number)
        VALUES(:zname,:zprice_request,:zcity,:zphone,:zrequest_order,:zrequest_number)
        ");
        $stmt->execute(array(
            "zname" => $name,
            "zprice_request" => $price_request,
            "zcity" => $city,
            "zphone" => $phone,
            "zrequest_order" => $request_order,
            "zrequest_number" => $final_number,
        ));
        if ($stmt) {
?>
            <script src='themes/js/jquery.min.js'></script>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "تم ارسال طلبك بنجاح",
                        icon: "success",
                        buttons: {
                            cancel: "اغلاق ! ",
                            defeat: false,
                        },
                    })
                });
            </script>
        <?php

        }
    } else {
        foreach ($formerror as $error) {
        ?>
            <li class="alert alert-danger"> <?php echo $error; ?> </li>
<?php
        }
    }
}
?>
<div class="transfer_details send_request">
    <div class="container">
        <div class="data">
            <?php
            if (isset($final_number)) {
            ?>
                <div class="alert alert-info"> رقم الطلب الخاص بك :: <strong> <?php echo $final_number; ?> </strong> </div>
            <?php
            }
            ?>

            <form action="" method="post">
                <h2> استمارة طلب الحصول علي مبلغ </h2>
                <div class="group_form">
                    <label for="name"> الأسم بالكامل </label>
                    <input required type="text" class="form-control" name="name">
                </div>
                <div class="group_form">
                    <label for="name"> المبلغ المطلوب </label>
                    <input required type="number" class="form-control" name="price_request">
                </div>
                <div class="group_form">
                    <label for="name"> المحافطة </label>
                    <input required type="text" class="form-control" name="city">
                </div>
                <div class="group_form">
                    <label for="name"> رقم الهاتف </label>
                    <input required type="text" class="form-control" name="phone">
                </div>
                <div class="group_form">
                    <label for="name"> تاريخ استلام الطلب </label>
                    <input required type="date" class="form-control" name="request_order">
                </div>
                <div class="group_form">
                    <br>
                    <button class="btn" type="submit" name="send_request"> ارسال </button>
                </div>
            </form>


        </div>

    </div>
</div>
<?php
include $tem . 'footer.php';
ob_end_flush();
?>