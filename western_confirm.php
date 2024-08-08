<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM confirm_page_western");
$stmt->execute();
$confirm_data = $stmt->fetch();
$title = $confirm_data['title'];
$title2 = $confirm_data['title2'];
$desc1 = $confirm_data['desc1'];
$desc2 = $confirm_data['desc2'];


$stmt = $connect->prepare("SELECT * FROM western_page");
$stmt->execute();
$indexdata = $stmt->fetch();

$penfit_percent = $indexdata['penfit_percent'];
$western_info_send = $indexdata['western_info_send'];

?>
<div class="confirm_order">
    <div class="container">
        <div class="data">
            <h4> <?php echo $title ?></h4>
        </div>
        <div class="info">
            <?php
            if (isset($_POST['confirm_order'])) {
                $formerror = [];
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
                } else {
                    $formerror[] = '  من فضلك ادخل صورة تاكيد الدفعد ';
                }

                /////////Insert Id Image /////////
                if (!empty($_FILES['id_number_image']['name'])) {
                    // // الحصول على الاسم الأصلي للملف
                    $id_number_image_name = $_FILES['id_number_image']['name'];
                    $id_number_image_name = str_replace(' ', '', $id_number_image_name);
                    $id_number_image_temp = $_FILES['id_number_image']['tmp_name'];
                    $id_number_image_type = $_FILES['id_number_image']['type'];
                    $id_number_image_size = $_FILES['id_number_image']['size'];
                    $id_number_image_uploaded = time() . '_' . $id_number_image_name;
                    move_uploaded_file($id_number_image_temp, 'admin/wester_orders/uploads/' . $id_number_image_uploaded);
                } else {
                    $formerror[] = ' من فضلك ادخل صورة اثبات البطاقة الشخصية  ';
                }
                $how_pay = $_SESSION['how_pay'];

                if (empty($formerror)) {
                    $stmt = $connect->prepare("UPDATE western SET how_pay = ? , id_number_image = ? ,pay_image = ? WHERE order_number =  ?");
                    $stmt->execute(array($how_pay, $id_number_image_uploaded, $image_confirm_order_uploaded, $_SESSION['order_number']));
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
                    foreach ($formerror as $error) {
                    ?>
                        <div class="alert alert-danger"> <?php echo $error; ?> </div>
            <?php
                    }
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
                            <label for="how_pay"> كيف ستدفع <span style="color: red;"> * </span> </label>
                            <select name="how_pay" id="how_pay" class="form-control">
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM western_payment_methods");
                                $stmt->execute();
                                $allpayments = $stmt->fetchAll();
                                foreach ($allpayments as $payment) {
                                ?>
                                    <option value="<?php echo $payment['id'] ?>" <?php echo (isset($_SESSION['how_pay']) && $_SESSION['how_pay'] ==  $payment['id']) ? 'selected' : ''; ?>><?php echo $payment['title'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="box box_info box_neo">
                            <h6> تعليمات التحويل </h6>
                            <ul class="list-unstyled">
                                <?php
                                $western_infos = explode(',', $western_info_send);
                                foreach ($western_infos as $info) {
                                ?>
                                    <li><?php echo $info; ?></li>
                                <?php
                                }
                                ?>
                            </ul>

                            <?php
                            foreach ($allpayments as $payment) {
                            ?>
                                <div class="payment_desc" id="payment_<?php echo $payment['id']; ?>" style="display: none;">
                                    <p><?php echo html_entity_decode($payment['description']); ?></p>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- <h6> معلومات زين كاش </h6>
                                <p> سأدفع عبر زين كاش <span> :: </span> 07841859371 </p>

                                <h6> دفع عبر باركود </h6>

                                <img width="200px" height="200px" src="uploads/cach_code.jpeg" alt=""> -->
                        </div>
                        <!-- <div class="box box_info box_fib">
                                <h6> تعليمات التحويل </h6>
                                <ul class="list-unstyled">
                                    <?php
                                    $western_infos = explode(',', $western_info_send);
                                    foreach ($western_infos as $info) {
                                    ?>
                                        <li> <?php echo $info; ?> </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                                <h6> ماستر كارد الرافدين </h6>
                                <p> 5213720456189039 </p>
                            </div> -->
                        <div class="box">
                            <label for="id_number_image"> ارفاق صورة اثبات بطاقة شخصية <span style="color: red;"> * </span> </label>
                            <input type="file" name="id_number_image" class="form-control">
                        </div>
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
    $(document).ready(function() {
        $('#how_pay').change(function() {
            var selectedPaymentId = $(this).val();
            $('.payment_desc').hide(); // اخفاء كل التعليمات
            $('#payment_' + selectedPaymentId).show(); // اظهار التعليمات المختارة
        });

        // عرض التعليمات الخاصة بوسيلة الدفع المحددة عند تحميل الصفحة
        var selectedPaymentId = $('#how_pay').val();
        if (selectedPaymentId) {
            $('#payment_' + selectedPaymentId).show();
        }
    });

</script>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>