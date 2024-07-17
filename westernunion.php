<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM western_page");
$stmt->execute();
$indexdata = $stmt->fetch();

$penfit_percent = $indexdata['penfit_percent'];
$western_info_send = $indexdata['western_info_send'];










?>

<div id="page-content">

    <div class="western_info">
        <div class="container">
            <div class="data">
                <div class="row">
                    <?php


                    $stmt = $connect->prepare("SELECT * FROM wester_box ORDER BY id DESC");
                    $stmt->execute();
                    $allrecord = $stmt->fetchAll();
                    foreach ($allrecord as $record) {
                    ?>
                        <div class="col-lg-3 col-12">
                            <div class="info" data-aos="fade-up">
                                <div class="image">
                                    <img src="admin/western_page/wester_box/uploads/<?php echo $record['image']; ?>" alt="">
                                </div>
                                <div class="info_data">
                                    <h2> <?php echo $record['title']; ?> </h2>
                                    <p> <?php echo $record['description']; ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>


    <?php
    // الخطوة الحالية
    $step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

    // الاحتفاظ بالبيانات بين الصفحات
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    // معالجة تحميل الملف
    if (isset($_FILES['id_number_image']) && $_FILES['id_number_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads2/';
        $upload_file = $upload_dir . basename($_FILES['id_number_image']['name']);
        if (move_uploaded_file($_FILES['id_number_image']['tmp_name'], $upload_file)) {
            $_SESSION['id_number_image'] = $upload_file;
        }
    }

    ?>

    <div class="form_western">
        <div class="container">
            <div class="data">
                <?php
                switch ($step) {
                    case 1:
                ?>

                        <form action="westernunion?step=2" method="post" enctype="multipart/form-data">
                            <h6 class="form_title"> بيانات الحوالة </h6>
                            <div class="box">
                                <label for="phone"> رقم الهاتف الخاص بك <span style="color: red;"> * </span> </label>
                                <input type="text" name="phone" required class="form-control" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="sender_name"> اسم المرسل<span style="color: red;"> * </span> </label>
                                <input type="text" name="sender_name" required class="form-control" value="<?php echo isset($_SESSION['sender_name']) ? $_SESSION['sender_name'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="reciever_name"> اسم المستلم<span style="color: red;"> * </span> </label>
                                <input type="text" name="reciever_name" required class="form-control" value="<?php echo isset($_SESSION['reciever_name']) ? $_SESSION['reciever_name'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="country_area_sender"> الرجاء كتابة الدولة والمنطقة المرسل منها <span style="color: red;"> * </span> </label>
                                <input type="text" name="country_area_sender" required class="form-control" value="<?php echo isset($_SESSION['country_area_sender']) ? $_SESSION['country_area_sender'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="country_area_reciever"> الرجاء كتابة الدولة والمنطقة المرسل اليها <span style="color: red;"> * </span> </label>
                                <input type="text" name="country_area_reciever" required class="form-control" value="<?php echo isset($_SESSION['country_area_reciever']) ? $_SESSION['country_area_reciever'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="email"> البريد الخاص بك <span style="color: red;"> * </span> </label>
                                <input type="text" name="email" required class="form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="amount"> المبلغ<span style="color: red;"> * </span> </label>
                                <select name="amount" id="amount" class="form-control">
                                    <option value="200" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 200) ? 'selected' : ''; ?>>$ 200</option>
                                    <option value="400" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 400) ? 'selected' : ''; ?>>$ 400</option>
                                    <option value="500" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 500) ? 'selected' : ''; ?>>$ 500</option>
                                    <option value="1000" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 1000) ? 'selected' : ''; ?>>$ 1000</option>
                                    <option value="2000" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 2000) ? 'selected' : ''; ?>>$ 2000</option>
                                    <option value="3000" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 3000) ? 'selected' : ''; ?>>$ 3000</option>
                                    <option value="4000" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 4000) ? 'selected' : ''; ?>>$ 4000</option>
                                    <option value="5000" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 5000) ? 'selected' : ''; ?>>$ 5000</option>
                                    <option value="7500" <?php echo (isset($_SESSION['amount']) && $_SESSION['amount'] == 7500) ? 'selected' : ''; ?>>$ 7500</option>
                                </select>
                            </div>
                            <div class="box">
                                <input type="checkbox" id="confirm_checked" name="confirm_checked" value="1" <?php echo (isset($_SESSION['confirm_checked']) && $_SESSION['confirm_checked'] == 1) ? 'checked' : ''; ?> required>
                                <label for="confirm_checked"> <?php echo $penfit_percent; ?> </label>
                            </div>
                            <div class="box">
                                <label for="transfer_method"> تحويل عبر <span style="color: red;"> * </span> </label>
                                <select name="transfer_method" id="transfer_method" class="form-control select2">
                                    <option value="western" <?php echo (isset($_SESSION['transfer_method']) && $_SESSION['transfer_method'] == 'western') ? 'selected' : ''; ?>> ويسترن يونيون </option>
                                </select>
                            </div>
                            <div class="paginate_buttons d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit"> التالي <i class="fa fa-arrow-left"></i> </button>
                            </div>
                        </form>
                    <?php
                        break;
                    case 2:
                    ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <h6 class="form_title"> تأكيد التحويل </h6>
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
                                <label for="pay_image"> ارفاق صورة اثبات تحويل المبلغ<span style="color: red;"> * </span> </label>
                                <input type="file" name="pay_image" class="form-control">
                            </div>
                            <div class="paginate_buttons d-flex justify-content-end">
                                <button class="btn btn-danger" type="submit" name="previous" formaction="westernunion?step=1"> الرجوع الي الخلف </button>
                                <button style="margin: 0 10px;" class="btn btn-primary" name="send_request" type="submit">ارسال </button>
                            </div>
                        </form>
                <?php
                }
                ?>
            </div>
            <?php
            if (isset($_POST['send_request'])) {
                try {
                    $formerror = [];
                    $phone = $_SESSION['phone'];
                    $sender_name = $_SESSION['sender_name'];
                    $reciever_name = $_SESSION['reciever_name'];
                    $country_area_sender = $_SESSION['country_area_sender'];
                    $country_area_reciever     = $_SESSION['country_area_reciever'];
                    $email = $_SESSION['email'];
                    $amount = $_SESSION['amount'];
                    $transfer_method = $_SESSION['transfer_method'];
                    $how_pay = $_SESSION['how_pay'];
                    date_default_timezone_set('Asia/Baghdad');
                    $date = date('Y-m-d H:i');
                    ///////////////// Upload Id Number Images 

                    ///////////Insert Id Image /////////
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
                    /////////////////// Insert Pay Image
                    if (!empty($_FILES['pay_image']['name'])) {
                        $pay_image_name = $_FILES['pay_image']['name'];
                        $pay_image_name = str_replace(' ', '', $pay_image_name);
                        $pay_image_temp = $_FILES['pay_image']['tmp_name'];
                        $pay_image_type = $_FILES['pay_image']['type'];
                        $pay_image_size = $_FILES['pay_image']['size'];
                        $pay_image_uploaded = time() . '_' . $pay_image_name;
                        move_uploaded_file($pay_image_temp, 'admin/wester_orders/uploads/' . $pay_image_uploaded);
                    } else {
                        $formerror[] = ' من فضلك ادخل صورة اثبات تحويل المبلغ  ';
                    }

                    // get the order number 
                    $stmt = $connect->prepare("SELECT * FROM western ORDER BY id DESC");
                    $stmt->execute();
                    $last_order = $stmt->fetch();
                    $last_order_number = $last_order['order_number'];
                    $new_order_number = $last_order_number + 1;
                    $_SESSION['order_number'] = $new_order_number;
                    if (empty($formerror)) {
                        $stmt = $connect->prepare("INSERT INTO western (order_number,phone,sender_name,reciever_name,country_area_sender,country_area_reciever,email,amount,transfer_method,how_pay,id_number_image,pay_image,created_at)
                        VALUES(:zorder_number,:zphone,:zsender_name,:zreciever_name,:zcountry_area_sender,:zcountry_area_reciever,:zemail,:zamount,:ztransfer_method,:zhow_pay,:zid_number_image,:zpay_image,:zcreated_at)
                        ");
                        $stmt->execute(array(
                            "zorder_number" => $new_order_number,
                            'zphone' => $phone,
                            "zsender_name" => $sender_name,
                            "zreciever_name" => $reciever_name,
                            "zcountry_area_sender" => $country_area_sender,
                            "zcountry_area_reciever" => $country_area_reciever,
                            'zemail' => $email,
                            "zamount" => $amount,
                            "ztransfer_method" => $transfer_method,
                            "zhow_pay" => $how_pay,
                            "zid_number_image" => $id_number_image_uploaded,
                            "zpay_image" => $pay_image_uploaded,
                            "zcreated_at" => $date,
                        ));
                        if ($stmt) {
                            // Location:("href");
                            header('Location:western_confirm');
                            // session_unset();
                            // session_destroy();
                        }
                    } else {
                        foreach ($formerror as $error) {
            ?>
                            <div class="alert alert-danger"> <?php echo $error; ?> </div>
            <?php
                        }
                    }
                } catch (\Exception $e) {
                    echo $e;
                }
            }


            ?>
        </div>
    </div>

</div>
<style>
    /* .box_neo {
        display: block;
    }

    .box_fib {
        display: none;
    }

    .box_raf {
        display: none;
    } */
</style>


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




    // document.addEventListener('DOMContentLoaded', function() {
    //     const howPaySelect = document.getElementById('how_pay');
    //     const boxNeo = document.querySelector('.box_neo');
    //     const boxFib = document.querySelector('.box_fib');
    //     const boxRaf = document.querySelector('.box_raf');

    //     function toggleBoxes() {
    //         const value = howPaySelect.value;
    //         boxNeo.style.display = 'none';
    //         boxFib.style.display = 'none';
    //         boxRaf.style.display = 'none';

    //         if (value === 'زين كاش') {
    //             boxNeo.style.display = 'block';
    //         } else if (value === 'ماستر كارد الرافدين') {
    //             boxFib.style.display = 'block';
    //         }
    //     }

    //     howPaySelect.addEventListener('change', toggleBoxes);

    //     // استدعاء الوظيفة عند تحميل الصفحة لضبط الحالة الأولية
    //     toggleBoxes();
    // });
</script>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>