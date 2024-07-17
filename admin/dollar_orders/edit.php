<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> تفاصيل طلب حجز دولار </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> تفاصيل طلب حجز دولار </li>
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

$stmt = $connect->prepare("SELECT * FROM dollar WHERE id = ?");
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
                                            <label for="dollar_amount"> تاريخ الطلب <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" class="form-control" name="" value="<?php echo $order_data['created_at']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="dollar_amount"> المبلغ <span style="color: red;"> * </span> </label>
                                            <select disabled name="dollar_amount" class="form-control" id="">
                                                <option value="3000"> 3.960.000 دينار عراقي - 3000$ </option>
                                            </select>
                                        </div>

                                        <div class="box">
                                            <label for="dollar_phone"> هل انت من حجاج بيت الله <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="dollar_phone" required class="form-control" value="<?php echo $order_data['allah'] ?>">
                                        </div>
                                        <div class="box">
                                            <label for="dollar_phone"> نوع السفر <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="port_type" required class="form-control" value="<?php echo $order_data['port_type'] ?>">
                                        </div>

                                        <div class="box">
                                            <label for="dollar_phone"> من اين تريد استلام الدولار <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="where_receieve_dollar" required class="form-control" value="<?php echo $order_data['where_receieve_dollar'] ?>">
                                        </div>

                                        <div class="box">
                                            <label for="dollar_phone"> رقم الهاتف <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="dollar_phone" required class="form-control" value="<?php echo $order_data['dollar_phone']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="dollar_name"> الاسم <span style="color: red;"> * </span> </label>
                                            <input type="text" readonly disabled name="dollar_name" required class="form-control" value="<?php echo  $order_data['dollar_name']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="travel_date"> تاريخ السفر <span style="color: red;"> * </span> </label>
                                            <input type="text" disabled readonly name="travel_date" required class="form-control" value="<?php echo $order_data['travel_date']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="travel_to"> بلد الوجهة <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="travel_to" required class="form-control" value="<?php echo $order_data['travel_to']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="dollar_how_pay"> كيف ستدفع <span style="color: red;"> * </span> </label>
                                            <input disabled readonly type="text" name="dollar_how_pay" required class="form-control" value="<?php echo $order_data['dollar_how_pay']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="box">
                                            <label for="passport_image"> ارفاق صورة جواز السفر <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="dollar_orders/uploads/<?php echo $order_data['passport_image'] ?>"> <img width="80px" height="80px" src="dollar_orders/uploads/<?php echo $order_data['passport_image'] ?>" alt=""> </a>
                                        </div>
                                        <div class="box">
                                            <label for="passport_image"> صورة تذكرة السفر  <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="dollar_orders/uploads/<?php echo $order_data['ticket_image'] ?>"> <img width="80px" height="80px" src="dollar_orders/uploads/<?php echo $order_data['ticket_image'] ?>" alt=""> </a>
                                        </div>
                                        <!-- <div class="box">
                                            <label for="id_image_first"> صورة البطاقة الموحدة  <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="dollar_orders/uploads/<?php echo $order_data['id_image_first'] ?>"> <img width="80px" height="80px" src="dollar_orders/uploads/<?php echo $order_data['id_image_first'] ?>" alt=""> </a>
                                        </div> 
                                        <div class="box">
                                            <label for="person_image"> ارفاق صورة لوجهك بشكل واضح <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="dollar_orders/uploads/<?php echo $order_data['person_image'] ?>"> <img width="80px" height="80px" src="dollar_orders/uploads/<?php echo $order_data['person_image'] ?>" alt=""> </a>
                                        </div> -->

                                        <div class="box">
                                            <label for="person_image"> صورة اثبات الدفع <span style="color: red;"> * </span> </label>
                                            <a target="_blank" href="dollar_orders/uploads/<?php echo $order_data['image_confirm_order'] ?>"> <img width="80px" height="80px" src="dollar_orders/uploads/<?php echo $order_data['image_confirm_order'] ?>" alt=""> </a>
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
                            $stmt = $connect->prepare("UPDATE dollar SET order_status = ? WHERE id = ?");
                            $stmt->execute(array($status, $order_id));
                            if ($stmt) {
                                $_SESSION['success_message'] = " تم التعديل بنجاح ";
                                header('Location: main.php?dir=dollar_orders&page=edit&order_id=' . $order_id);
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