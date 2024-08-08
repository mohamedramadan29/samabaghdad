<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM confirm_page_western");
$stmt->execute();
$confirm_data =$stmt->fetch();
$title = $confirm_data['title'];
$title2 = $confirm_data['title2'];
$desc1 = $confirm_data['desc1'];
$desc2 = $confirm_data['desc2'];
?>
<div class="confirm_order">
    <div class="container">
        <div class="data">
            <h4> <?php echo $title ?></h4>
        </div>
        <div class="info">
            <?php
            if (isset($_POST['confirm_order'])) {
                ///////////Insert Confirm Order  /////////



                if (!empty($_FILES['image_confirm_order']['name'])) {
                    // // الحصول على الاسم الأصلي للملف
                    $image_confirm_order_name = $_FILES['image_confirm_order']['name'];
                    $image_confirm_order_name = str_replace(' ', '', $image_confirm_order_name);
                    $image_confirm_order_temp = $_FILES['image_confirm_order']['tmp_name'];
                    $image_confirm_order_type = $_FILES['image_confirm_order']['type'];
                    $image_confirm_order_size = $_FILES['image_confirm_order']['size'];
                    $image_confirm_order_uploaded = time() . '_' . $image_confirm_order_name;
                    move_uploaded_file($image_confirm_order_temp, 'admin/wester_orders/uploads/' . $image_confirm_order_uploaded);
                    $stmt = $connect->prepare("UPDATE western SET pay_image = ? WHERE order_number =  ?");
                    $stmt->execute(array($image_confirm_order_uploaded, $_SESSION['order_number']));
                    if ($stmt) {
            ?>
                        <div class="alert alert-success">
                            تم تاكيد طلبك
                        </div>
            <?php
                        session_unset();
                        session_destroy();
                        header("Refresh:2; url=westernunion");
                    }
                } else {
                    $formerror[] = '  من فضلك ادخل صورة تاكيد الدفعد ';
                }
            }

            ?>
            <h5> <?php echo $title2; ?></h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="color:#27ae60;"> رقم الدور </th>
                        <th style="color:#27ae60;"> <?php
                                                    $randomNumber = rand(10, 100);
                                                    echo $randomNumber;
                                                    ?> </th>
                    </tr>
                    <tr>
                        <th style="color:#27ae60;"> رقم الطلب </th>
                        <th style="color:#27ae60;"> <?php echo $_SESSION['order_number']; ?> </th>
                    </tr>
                    <tr>
                        <th style="color:#27ae60;"> المبلغ </th>
                        <th style="color:#27ae60;"> <?php echo $_SESSION['amount']; ?> دولار </th>
                    </tr>
                    <tr>
                        <th style="color:#27ae60;"> حالة الطلب </th>
                        <th style="color:#27ae60;"> بإنتظار الدفع </th>
                    </tr>
                </tbody>
            </table>
            <p><?php echo html_entity_decode($desc1); ?></p>
 
            <div class="form_western" style="padding: 5px;">
                <div class="data">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="box">
                            <label for="image_confirm_order"> ارفق صورة اثبات تحويل المبلغ <span style="color: red;"> * </span> </label>
                            <input type="file" required name="image_confirm_order" class="form-control">
                        </div>
                        <div class="box">
                            <button type="submit" class="btn btn-primary" name="confirm_order"> تأكيد الحجز </button>
                        </div>

                    </form>

                </div>
            </div>

            <p><?php echo html_entity_decode($desc2); ?></p>
        </div>
    </div>
</div>



<?php

include $tem . 'footer.php';
ob_end_flush();


?>





<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>