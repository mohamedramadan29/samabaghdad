<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM tracking_page");
$stmt->execute();
$tracking_data = $stmt->fetch();
$desc = $tracking_data['desc'];
?>
<div class="confirm_order">
    <div class="container">
        <div class="data">
            <h4> متابعه الطلب </h4>
        </div>
        <div class="info">

            <?php
            if (isset($_POST['confirm_order'])) {
                $order_id = $_POST['order_id'];
                ///////////Insert Confirm Order  /////////
                if (!empty($_FILES['image_confirm_order']['name'])) {

                    $image_confirm_order_name = $_FILES['image_confirm_order']['name'];
                    $image_confirm_order_name = str_replace(' ', '', $image_confirm_order_name);
                    $image_confirm_order_temp = $_FILES['image_confirm_order']['tmp_name'];
                    $image_confirm_order_type = $_FILES['image_confirm_order']['type'];
                    $image_confirm_order_size = $_FILES['image_confirm_order']['size'];
                    $image_confirm_order_uploaded = time() . '_' . $image_confirm_order_name;
                    move_uploaded_file($image_confirm_order_temp, 'admin/dollar_orders/uploads/' . $image_confirm_order_uploaded);
                    $stmt = $connect->prepare("UPDATE dollar SET image_confirm_order = ? WHERE id =  ?");
                    $stmt->execute(array($image_confirm_order_uploaded, $order_id));
                    if ($stmt) {
            ?>
                        <div class="alert alert-success">
                            تم الارسال بنجاح
                        </div>
            <?php
                    }
                } else {
                    $formerror[] = ' من فضلك ادخل صورة تاكيد الدفعد ';
                }
            }
            ?>
            <p><?php echo html_entity_decode($desc); ?></p>
            <br>
            <div class="form_tracking">
                <form method="post" action="">
                    <div class="box">
                        <label for=""> من فضلك ادخل رقم الطلب </label>
                        <input required type="number" min='1' class="form-control" name="order_number" value="<?php if(isset($_REQUEST['order_number'])) echo $_REQUEST['order_number'] ?>">
                    </div>
                    <div class="box">
                        <button type="submit" name="track_order" class="btn btn-primary btn-sm"> متابعه الطلب <i class="fa fa-eye"></i> </button>
                    </div>
                </form>
                <?php
                if (isset($_POST['track_order'])) {
                    $order_number = $_POST['order_number'];
                    /////// First Check The ORder Is Found Or Not 

                    $stmt = $connect->prepare("SELECT * FROM dollar WHERE order_number=?");
                    $stmt->execute(array($order_number));
                    $count_orders = $stmt->rowCount();
                    if ($count_orders > 0) {
                        $order_data = $stmt->fetch();
                ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="color:#27ae60;"> رقم الدور </th>
                                    <th style="color:#27ae60;"> <?php
                                                                echo $order_data['step_number'];
                                                                ?> </th>
                                </tr>
                                <tr>
                                    <th style="color:#27ae60;"> رقم الطلب </th>
                                    <th style="color:#27ae60;"> <?php echo $order_data['order_number']; ?> </th>
                                </tr>
                                <tr>
                                    <th style="color:#27ae60;"> المبلغ </th>
                                    <th style="color:#27ae60;"> <?php echo $order_data['dollar_amount']; ?> دولار </th>
                                </tr>
                                <tr>
                                    <th style="color:#27ae60;"> الاسم </th>
                                    <th style="color:#27ae60;"> <?php echo $order_data['dollar_name']; ?> </th>
                                </tr>
                                <tr>
                                    <th style="color:#27ae60;">تاريخ السفر </th>
                                    <th style="color:#27ae60;"> <?php echo $order_data['travel_date']; ?> </th>
                                </tr>
                                <tr>
                                    <th style="color:#27ae60;"> حالة الطلب </th>
                                    <th style="color:#27ae60;">
                                        <?php
                                        if ($order_data['order_status'] == 0) {
                                        ?>
                                            <span class="badge badge-warning bg-warning"> بإنتظار الدفع </span>
                                        <?php
                                        } elseif ($order_data['order_status'] == 1) {
                                        ?>
                                            <span class="badge badge-success bg-success"> تم الدفع </span>
                                        <?php
                                        } elseif ($order_data['order_status'] == 3) {
                                        ?>
                                            <span class="badge badge-info bg-info"> قيد المراجعه </span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge badge-danger bg-danger"> ملغي </span>
                                        <?php
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <?php
                        if ($order_data['order_status'] == 0) {
                        ?>
                            <div class="form_western" style="padding: 5px;">
                                <div class="data">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="box">
                                            <input type="hidden" name="order_id" value="<?php echo $order_data['id'] ?>">
                                            <label for="image_confirm_order"> ارفق صورة اثبات تحويل المبلغ <span style="color: red;"> * </span> </label>
                                            <input type="file" required name="image_confirm_order" class="form-control">
                                        </div>
                                        <div class="box">
                                            <button type="submit" class="btn btn-primary" name="confirm_order"> تأكيد الحجز </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        <?php
                        } elseif ($order_data['order_status'] == 1) {
                            include "admin/phpqrcode/qrlib.php";

                            // الحصول على معرف الطلب
                            $order_id = $order_data['id'];
                            
                            if (!$order_id) {
                                die('Order ID is missing.');
                            } 
                            
                            // جمع المعلومات لإنشاء الباركود
                            $name = $order_data['dollar_name'];
                            $date = $order_data['created_at'];
                            $travel_date = $order_data['travel_date'];
                            $order_number = $order_data['order_number'];
                            $serv_name = 'شراء الدولار لأغراض السفر';
                            $travel_to = $order_data['travel_to'];
                            $branch = $order_data['where_receieve_dollar'];
                            $amount = $order_data['dollar_amount'];
                            $order_step = $order_data['step_number'];
                            $info = ' تم تاكيد الطلب الخاص بك  ';
                            $qcodedata = "الاسم: $name\nالتاريخ: $date\nرقم الحجز: $order_number\nرقم الدور: $order_step\nالخدمة: $serv_name\nتاريخ السفر: $travel_date\nبلد الوجهة: $travel_to\nالفرع: $branch\nالمبلغ: $amount\n :: $info\n";
                            
                            // مسار حفظ الصورة لرمز الاستجابة السريعة
                            $newPath = 'admin/uploads/qr_codes/';
                            
                            // اسم الملف لرمز الاستجابة السريعة
                            $fileName = uniqid() . $name . ".png";
                            
                            // الجمع بين المسار واسم الملف للحصول على المسار الكامل للصورة
                            $fullFilePath = $newPath . $fileName;
                            
                            // تعيين إعدادات QR
                            QRcode::png($qcodedata, $fullFilePath, QR_ECLEVEL_H, 4);
                            
                            // عرض الصورة
                            echo '<img class="imgqrcode" src="' . $fullFilePath . '" />';
                            
                            ?>
                            <a href="<?php echo $fullFilePath; ?>" class="btn btn-primary btn-sm" download> تحميل الصورة <i class="fa fa-download"></i>  </a> 
                            <?php 
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger"> لا يوجد طلب بهذا الرقم </div>
                <?php
                    }
                }
                ?>
            </div>



        </div>
    </div>
</div>

<?php
//session_unset();
//session_destroy();
include $tem . 'footer.php';
ob_end_flush();
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<style>
    .form_tracking {}

    .form_tracking .box {
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .form_tracking .box input {
        outline: none;
        box-shadow: none;
        height: 50px;
        direction: rtl;
        text-align: right;
    }

    .form_tracking .box label {
        margin-bottom: 10px;
    }
    .imgqrcode{
        width: 200px;
        display: block;
    }
</style>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>