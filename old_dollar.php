<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM dollar_page");
$stmt->execute();
$indexdata = $stmt->fetch();

$banner_image = $indexdata['banner_image'];
$title1 = $indexdata['title1'];
$desc1 = $indexdata['desc1'];
$amount = $indexdata['amount'];
$recieve_dollar   = $indexdata['recieve_dollar'];



?>

<div id="page-content">

    <div class="western_info" style="margin: 0; padding:0;">
        <img style="max-width: 100%;" src="admin/dollar_page/uploads/<?php echo $banner_image; ?>" alt="">
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

    <div class="form_western form_dollar">
        <div class="container">
            <div class="data">
                <?php
                switch ($step) {
                    case 1:
                ?>
                        <form action="dollar?step=2" method="post" enctype="multipart/form-data">
                            <h6 class="form_title"> <?php echo $title1; ?></h6>
                            <div class="box restrict">
                                <?php echo html_entity_decode($desc1); ?>

                            </div>
                            <div class="box">
                                <input type="checkbox" id="confirm_checked" name="dollar_confirm_checked" value="1" <?php echo (isset($_SESSION['dollar_confirm_checked']) && $_SESSION['dollar_confirm_checked'] == 1) ? 'checked' : ''; ?> required>
                                <label for="confirm_checked"> قرأت كافة الشروط والإحكام واوافق عليها </label>
                            </div>
                            <div class="paginate_buttons d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit"> التالي <i class="fa fa-arrow-left"></i> </button>
                            </div>
                        </form>
                    <?php
                        break;
                    case 2:
                    ?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <h6 class="form_title"> تفاصيل الحجز </h6>
                            <div class="box">
                                <label for="dollar_amount"> المبلغ <span style="color: red;"> * </span> </label>
                                <select name="dollar_amount" class="form-control" id="">
                                    <option value="<?php echo $amount; ?>"> <?php echo $amount; ?> </option>
                                </select>
                            </div>
                            <div class="box">
                                <label for="allah"> هل انت من حجاج بيت الله <span style="color: red;"> * </span> </label>
                                <select name="allah" id="allah" class="form-control">
                                    <option value="نعم انا من الحجاج" <?php echo (isset($_SESSION['allah']) && $_SESSION['allah'] == 'نعم انا من الحجاج') ? 'selected' : ''; ?>>نعم انا من الحجاج</option>
                                    <option value="لا انا لست حاج" <?php echo (isset($_SESSION['allah']) && $_SESSION['allah'] == 'لا انا لست حاج') ? 'selected' : ''; ?>> لا انا لست حاج </option>
                                </select>
                            </div>
                            <div class="box">
                                <label for="port_type"> نوع السفر <span style="color: red;"> * </span> </label>
                                <select name="port_type" id="port_type" class="form-control">
                                    <option value="سفر بري" <?php echo (isset($_SESSION['port_type']) && $_SESSION['port_type'] == 'سفر بري') ? 'selected' : ''; ?>> سفر بري </option>
                                    <option value="سفر جوي" <?php echo (isset($_SESSION['port_type']) && $_SESSION['port_type'] == 'سفر جوي') ? 'selected' : ''; ?>> سفر جوي </option>
                                </select>
                            </div>

                            <div class="box">
                                <label for="where_receieve_dollar"> من اين تريد استلام الدولار <span style="color: red;"> * </span> </label>
                                <select name="where_receieve_dollar" id="where_receieve_dollar" class="form-control">
                                    <?php
                                    $recieve_dollars = explode(',', $recieve_dollar);
                                    foreach ($recieve_dollars as $recieve_dollar) { ?>
                                        <option value="<?php echo $recieve_dollar; ?>" <?php echo (isset($_SESSION['where_receieve_dollar']) && $_SESSION['where_receieve_dollar'] ==  $recieve_dollar) ? 'selected' : ''; ?>> <?php echo $recieve_dollar; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="box">
                                <label for="dollar_phone"> رقم الهاتف <span style="color: red;"> * </span> </label>
                                <input type="text" name="dollar_phone" required class="form-control" value="<?php echo isset($_SESSION['dollar_phone']) ? $_SESSION['dollar_phone'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="dollar_name"> الاسم <span style="color: red;"> * </span> </label>
                                <input type="text" name="dollar_name" required class="form-control" value="<?php echo isset($_SESSION['dollar_name']) ? $_SESSION['dollar_name'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="travel_date"> تاريخ السفر <span style="color: red;"> * </span> </label>
                                <input type="date" name="travel_date" required class="form-control" value="<?php echo isset($_SESSION['travel_date']) ? $_SESSION['travel_date'] : ''; ?>">
                            </div>
                            <div class="box">
                                <label for="travel_to"> بلد الوجهة <span style="color: red;"> * </span> </label>
                                <input type="text" name="travel_to" required class="form-control" value="<?php echo isset($_SESSION['travel_to']) ? $_SESSION['travel_to'] : ''; ?>">
                            </div>

                            <div class="box">
                                <label for="dollar_how_pay"> كيف ستدفع <span style="color: red;"> * </span> </label>
                                <select name="dollar_how_pay" id="dollar_how_pay" class="form-control">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM western_payment_methods");
                                    $stmt->execute();
                                    $allpayments = $stmt->fetchAll();
                                    foreach ($allpayments as $payment) {
                                    ?>
                                    <option value="<?php echo $payment['title']; ?>" <?php echo (isset($_SESSION['dollar_how_pay']) && $_SESSION['dollar_how_pay'] == $payment['title']) ? 'selected' : ''; ?>> <?php echo $payment['title']; ?></option>
                                    <?php
                                    }

                                    ?>
                                
                                </select>
                            </div>
                            <div class="box">
                                <label for="passport_image"> ارفاق صورة جواز السفر <span style="color: red;"> * </span> </label>
                                <input type="file" required name="passport_image" class="form-control">
                            </div>
                            <div class="box">
                                <label for="ticket_image"> ارفاق صورة تذكرة السفر <span style="color: red;"> * </span> </label>
                                <input type="file" required name="ticket_image" class="form-control">
                            </div>
                            <div class="paginate_buttons d-flex justify-content-end">
                                <button class="btn btn-danger" type="submit" name="previous" formaction="dollar?step=1"> الرجوع الي الخلف </button>
                                <button style="margin: 0 10px;" class="btn btn-primary" name="send_dollar_request" type="submit">ارسال </button>
                            </div>
                        </form>
                <?php
                }
                ?>
            </div>
            <?php
            if (isset($_POST['send_dollar_request'])) {
                try {
                    $formerror = [];
                    $dollar_amount = $_SESSION['dollar_amount'];
                    $allah = $_SESSION['allah'];
                    $port_type = $_SESSION['port_type'];
                    $where_receieve_dollar = $_SESSION['where_receieve_dollar'];
                    $dollar_phone     = $_SESSION['dollar_phone'];
                    $dollar_name = $_SESSION['dollar_name'];
                    $travel_date = $_SESSION['travel_date'];
                    $travel_to = $_SESSION['travel_to'];
                    $dollar_how_pay = $_SESSION['dollar_how_pay'];
                    date_default_timezone_set('Asia/Baghdad');
                    $date = date('Y-m-d H:i');
                    ///////////////// Upload Id Number Images 

                    ///////////Insert Passport Image /////////
                    if (!empty($_FILES['passport_image']['name'])) {

                        $passport_image_name = $_FILES['passport_image']['name'];
                        $passport_image_name = str_replace(' ', '', $passport_image_name);
                        $passport_image_temp = $_FILES['passport_image']['tmp_name'];
                        $passport_image_type = $_FILES['passport_image']['type'];
                        $passport_image_size = $_FILES['passport_image']['size'];
                        $passport_image_uploaded = time() . '_' . $passport_image_name;
                        move_uploaded_file($passport_image_temp, 'admin/dollar_orders/uploads/' . $passport_image_uploaded);
                    } else {
                        $formerror[] = ' من فضلك ادخل صورة جواز السفر ';
                    }
                    ///////////Insert Ticket Image  /////////
                    if (!empty($_FILES['ticket_image']['name'])) {

                        $ticket_image_name = $_FILES['ticket_image']['name'];
                        $ticket_image_name = str_replace(' ', '', $ticket_image_name);
                        $ticket_image_temp = $_FILES['ticket_image']['tmp_name'];
                        $ticket_image_type = $_FILES['ticket_image']['type'];
                        $ticket_image_size = $_FILES['ticket_image']['size'];
                        $ticket_image_uploaded = time() . '_' . $ticket_image_name;
                        move_uploaded_file($ticket_image_temp, 'admin/dollar_orders/uploads/' . $ticket_image_uploaded);
                    } else {
                        $formerror[] = ' من فضلك ادخل صورة تذكرة السفر  ';
                    }
                    // get the order number 
                    $stmt = $connect->prepare("SELECT * FROM dollar ORDER BY id DESC");
                    $stmt->execute();
                    $last_order = $stmt->fetch();
                    $last_order_number = $last_order['order_number'];
                    $new_order_number = $last_order_number + 1;
                    $_SESSION['order_number'] = $new_order_number;
                    if (empty($formerror)) {
                        $stmt = $connect->prepare("INSERT INTO dollar (order_number,dollar_amount,allah,port_type,where_receieve_dollar,
                        dollar_phone,dollar_name,travel_date,travel_to,dollar_how_pay,passport_image,ticket_image,id_image_first,person_image,created_at)
                        VALUES(:zorder_number,:zdollar_amount,:zallah,:zport_type,:zwhere_receieve_dollar,:zdollar_phone,:zdollar_name,
                        :ztravel_date,:ztravel_to,:zdollar_how_pay,:zpassport_image,:zticket_image,:zid_image_first,:zperson_image,:zcreated_at)
                        ");
                        $stmt->execute(array(
                            "zorder_number" => $new_order_number,
                            "zdollar_amount" => $dollar_amount,
                            "zallah" => $allah,
                            "zport_type" => $port_type,
                            "zwhere_receieve_dollar" => $where_receieve_dollar,
                            "zdollar_phone" => $dollar_phone,
                            "zdollar_name" => $dollar_name,
                            "ztravel_date" => $travel_date,
                            "ztravel_to" => $travel_to,
                            "zdollar_how_pay" => $dollar_how_pay,
                            "zpassport_image" => $passport_image_uploaded,
                            "zticket_image" => $ticket_image_uploaded,
                            "zid_image_first" => null,
                            "zperson_image" => null,
                            "zcreated_at" => $date
                        ));
                        if ($stmt) {
                            // Location:("href");
                            header('Location:dollar_confirm');
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
    .box_neo {
        display: block;
    }

    .box_fib {
        display: none;
    }

    .box_raf {
        display: none;
    }
</style>


<?php
include $tem . 'footer.php';
ob_end_flush();
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const howPaySelect = document.getElementById('how_pay');
        const boxNeo = document.querySelector('.box_neo');
        const boxFib = document.querySelector('.box_fib');
        const boxRaf = document.querySelector('.box_raf');

        function toggleBoxes() {
            const value = howPaySelect.value;
            boxNeo.style.display = 'none';
            boxFib.style.display = 'none';
            boxRaf.style.display = 'none';

            if (value === 'neo') {
                boxNeo.style.display = 'block';
            } else if (value === 'FIB') {
                boxFib.style.display = 'block';
            } else if (value === 'رافدين') {
                boxRaf.style.display = 'block';
            }
        }

        howPaySelect.addEventListener('change', toggleBoxes);

        // استدعاء الوظيفة عند تحميل الصفحة لضبط الحالة الأولية
        toggleBoxes();
    });
</script>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>