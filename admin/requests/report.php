<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> الاستمارات </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> الاستمارات </li>
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

                    <div class="card-header">
                        <button type="button" class="btn btn-primary waves-effect btn-sm" data-toggle="modal" data-target="#add-Modal"> أضافة سند صرف <i class="fa fa-plus"></i> </button>
                    </div>
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
                                        <th>الأسم </th>
                                        <th> المبلغ </th>
                                        <th> المحافظة </th>
                                        <th> رقم الهاتف </th>
                                        <th> التاريخ </th>
                                        <th> حالة الطلب </th>
                                        <th> رقم الطلب </th>
                                        <th> عمليات </th>
                                        <th> ملاحظات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM requests ORDER BY id DESC");
                                    $stmt->execute();
                                    $allrecord = $stmt->fetchAll();
                                    $i = 0;
                                    foreach ($allrecord as $record) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo  $record['name']; ?> </td>
                                            <td> <?php echo  $record['price_request']; ?> </td>
                                            <td> <?php echo  $record['city']; ?> </td>
                                            <td> <?php echo  $record['phone']; ?> </td>
                                            <td> <?php echo  $record['request_order']; ?> </td>
                                            <td> <?php
                                                    if ($record['status'] == 0) {
                                                    ?>
                                                    <span class="badge badge-warning"> تحت المراجعه </span>
                                                <?php
                                                    } elseif ($record['status'] == 1) {
                                                ?>
                                                    <span class="badge badge-success"> تم الطلب </span>
                                                <?php
                                                    } else {
                                                ?>
                                                    <span class="badge badge-danger"> تم الغاء الطلب </span>
                                                <?php
                                                    } ?>
                                            </td>
                                            <td> <?php echo  $record['request_number']; ?> </td>

                                            <td>
                                                <button type="button" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#edit-Modal_<?php echo $record['id']; ?>"> <i class='fa fa-pen'></i> </button>
                                                <a href="main.php?dir=requests&page=print&request_id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm"> <i class='fa fa-print'></i> </a>
                                                <a href="main.php?dir=requests&page=delete&request_id=<?php echo $record['id']; ?>" class="confirm btn btn-danger btn-sm"> <i class='fa fa-trash'></i> </a>
                                                <a href="main.php?dir=requests&page=document&request_id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm"> <i class='fa fa-file'></i> </a>
                                                <a href="main.php?dir=requests&page=small_print&request_id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm"> small <i class='fa fa-file'></i> </a>
                                            </td>
                                            <td> <?php echo  $record['note']; ?> </td>
                                        </tr>
                                        <!-- EDIT NEW CATEGORY MODAL   -->
                                        <div class="modal fade" id="edit-Modal_<?php echo $record['id']; ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> تعديل حالة الطلب </h4>
                                                    </div>
                                                    <form method="post" action="main.php?dir=requests&page=edit" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type='hidden' name="request_id" value="<?php echo $record['id']; ?>">
                                                                <label for="Company-2" class="block">حالة الطلب </label>
                                                                <select name="status" class="form-control" id="">
                                                                    <option value=""> تغير الحالة </option>
                                                                    <option value="1" <?php if ($record['status'] == 1) echo 'selected'; ?>> تم الطلب </option>
                                                                    <option value="0" <?php if ($record['status'] == 0) echo 'selected'; ?>> تحت المراجعه </option>
                                                                    <option value="2" <?php if ($record['status'] == 2) echo 'selected'; ?>> تم الغاء الطلب </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> رقم الطلب </label>
                                                                <input type="text" class="form-control" name="request_number" value="<?php echo $record['request_number']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> ملاحظات </label>
                                                                <textarea type="text" class="form-control" name="note"><?php echo $record['note']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit_cat" class="btn btn-primary waves-effect waves-light "> تعديل </button>
                                                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">رجوع</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ADD NEW CATEGORY MODAL   -->
                <div class="modal fade" id="add-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">أضافة سند صرف </h4>
                            </div>
                            <form action="main.php?dir=requests&page=add" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name"> الأسم بالكامل </label>
                                        <input required type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> المبلغ المطلوب </label>
                                        <input required type="number" class="form-control" name="price_request">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> المحافطة </label>
                                        <input required type="text" class="form-control" name="city">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رقم الهاتف </label>
                                        <input required type="text" class="form-control" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> تاريخ استلام الطلب </label>
                                        <input required type="date" class="form-control" name="request_order">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> ملاحظات </label>
                                        <textarea type="text" class="form-control" name="note"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="add_cat" class="btn btn-primary waves-effect waves-light "> حفظ </button>
                                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal"> رجوع </button>
                                </div>
                            </form>
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