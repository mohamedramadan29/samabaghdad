<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> طلبات حجز دولار للمسافرين </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> طلبات حجز دولار للمسافرين </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->


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
                        <div class="table-responsive">
                            <table id="my_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> رقم الطلب </th>
                                        <th> الاسم </th>
                                        <th> رقم الهاتف </th>
                                        <th> المبلغ </th>
                                        <th> تاريخ الطلب </th>
                                        <th> حالة الطلب </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $stmt = $connect->prepare("SELECT * FROM dollar ORDER BY id DESC");
                                    $stmt->execute();
                                    $allrecord = $stmt->fetchAll();
                                    foreach ($allrecord as $record) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo  $record['order_number']; ?> </td>
                                            <td> <?php echo  $record['dollar_name']; ?> </td>
                                            <td> <?php echo  $record['dollar_phone']; ?> </td>
                                            <td> <?php echo  $record['dollar_amount']; ?> دولار </td>
                                            <td> <?php echo  $record['created_at']; ?> </td>
                                            <td> <?php
                                                    if ($record['order_status'] == 0) {
                                                    ?>
                                                    <span class="badge badge-warning"> بإنتظار الدفع </span>
                                                <?php
                                                    } elseif ($record['order_status'] == 1) {
                                                ?>
                                                    <span class="badge badge-success"> تم الدفع </span>
                                                <?php
                                                    } elseif ($record['order_status'] == 3) {
                                                ?>
                                                    <span class="badge badge-info"> قيد المراجعه </span>
                                                <?php
                                                    } else {
                                                ?>
                                                    <span class="badge badge-danger"> ملغي </span>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="main.php?dir=dollar_orders&page=edit&order_id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm"> <i class='fa fa-edit'></i> </a>
                                                <a href="main.php?dir=dollar_orders&page=print&order_id=<?php echo $record['id']; ?>" class="btn btn-warning btn-sm"> <i class='fa fa-print'></i> </a>
                                                <a href="main.php?dir=dollar_orders&page=qrcode&order_id=<?php echo $record['id']; ?>" class="btn btn-success btn-sm"> <i class='fa fa-barcode'></i> </a>
                                                <a href="main.php?dir=dollar_orders&page=delete&order_id=<?php echo $record['id']; ?>" class="confirm btn btn-danger btn-sm"> <i class='fa fa-trash'></i> </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<style>
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 600px;
            margin: 1.75rem auto;
        }
    }
</style>