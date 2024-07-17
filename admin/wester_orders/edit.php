<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> تفاصيل الطلب </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> تفاصيل الطلب </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<?php

$order_id = $_GET['order_id'];

$stmt = $connect->prepare("SELECT * FROM western WHERE id = ?");
$stmt->execute(array($order_id));
$order_data = $stmt->fetch();

?>

<!-- DOM/Jquery table start -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php
                    if (isset($_SESSION['success_message'])) {
                        $message = $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                    ?>
                        <?php
                        ?>
                        <script src="plugins/jquery/jquery.min.js"></script>
                        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                        <script>
                            $(function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: '<?php echo $message; ?>',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            })
                        </script>
                        <?php
                    } elseif (isset($_SESSION['error_messages'])) {
                        $formerror = $_SESSION['error_messages'];
                        foreach ($formerror as $error) {
                        ?>
                            <div class="alert alert-danger alert-dismissible" style="max-width: 800px; margin:20px">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $error; ?>
                            </div>
                    <?php
                        }
                        unset($_SESSION['error_messages']);
                    }
                    ?>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="box">
                                            <label for="phone"> تاريخ الطلب <span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="phone" required class="form-control" value="<?php echo $order_data['created_at']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="phone"> رقم الهاتف الخاص بك <span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="phone" required class="form-control" value="<?php echo $order_data['phone']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="sender_name"> اسم المرسل<span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="sender_name" required class="form-control" value="<?php echo $order_data['sender_name']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="reciever_name"> اسم المستلم<span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="reciever_name" required class="form-control" value="<?php echo $order_data['reciever_name']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="country_area_sender"> الرجاء كتابة الدولة والمنطقة المرسل منها <span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="country_area_sender" required class="form-control" value="<?php echo $order_data['country_area_sender']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="country_area_reciever"> الرجاء كتابة الدولة والمنطقة المرسل اليها <span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="country_area_reciever" required class="form-control" value="<?php echo $order_data['country_area_reciever']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="email"> البريد الخاص بك <span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="email" required class="form-control" value="<?php echo $order_data['email']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="amount"> المبلغ<span style="color: red;"> * </span> </label>
                                            <input readonly disabled type="text" name="email" required class="form-control" value="<?php echo $order_data['amount']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="box">
                                            <label for="transfer_method"> تحويل عبر <span style="color: red;"> * </span> </label>
                                            <select disabled name="transfer_method" id="transfer_method" class="form-control select2">
                                                <option selected value="western" <?php echo (isset($_SESSION['transfer_method']) && $_SESSION['transfer_method'] == 'western') ? 'selected' : ''; ?>> ويسترن يونيون </option>
                                            </select>
                                        </div>

                                        <div class="box">
                                            <label for="how_pay"> كيف ستدفع <span style="color: red;"> * </span> </label>
                                            <?php 
                                            $stmt = $connect->prepare("SELECT * FROM western_payment_methods WHERE id = ?");
                                            $stmt->execute(array($order_data['how_pay']));
                                            $pay_data = $stmt->fetch();
                                            $pay_name = $pay_data['title'];
                                            
                                            ?>
                                            <input readonly disabled type="text" name="how_pay" required class="form-control" value="<?php echo $pay_name; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="id_number_image"> ارفاق صورة اثبات بطاقة شخصية <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="wester_orders/uploads/<?php echo $order_data['id_number_image'] ?>">
                                                <img width='80px' height="80px" src="wester_orders/uploads/<?php echo $order_data['id_number_image'] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="box">
                                            <label for="pay_image"> ارفاق صورة اثبات تحويل المبلغ<span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="wester_orders/uploads/<?php echo $order_data['pay_image'] ?>">
                                                <img width='80px' height="80px" src="wester_orders/uploads/<?php echo $order_data['pay_image'] ?>" alt="">
                                            </a>
                                        </div>

                                        <div class="box">
                                            <label for="status"> تعديل حالة الطلب </label>
                                            <select name="status" id="status" class="form-control select2">
                                                <option <?php if ($order_data['order_status'] == 0) echo "selected"; ?> value="0"> بانتظار الدفع </option>
                                                <option <?php if ($order_data['order_status'] == 1) echo "selected"; ?> value="1"> تم الدفع </option>
                                                <option <?php if ($order_data['order_status'] == 2) echo "selected"; ?> value="2"> ملغي </option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit_order" class="btn btn-primary waves-effect waves-light "> حفظ </button>
                                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal"> رجوع </button>
                            </div>
                        </form>

                        <?php

                        if (isset($_POST['edit_order'])) {
                            $status = $_POST['status'];
                            $stmt = $connect->prepare("UPDATE western SET order_status = ? WHERE id = ?");
                            $stmt->execute(array($status, $order_id));
                            if ($stmt) {
                                $_SESSION['success_message'] = " تم التعديل بنجاح ";
                                header('Location: main.php?dir=wester_orders&page=edit&order_id=' . $order_id);
                                exit();
                            }
                        }

                        ?>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>