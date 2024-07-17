<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> الوكلاء </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> الوكلاء </li>
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
                        <button type="button" class="btn btn-primary waves-effect btn-sm" data-toggle="modal" data-target="#add-Modal"> اضافة وكيل <i class="fa fa-plus"></i> </button>
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
                                        <th> اسم الشركة </th>
                                        <th> العنوان </th>
                                        <th> تفاصيل العنوان </th>
                                        <th> رقم الهاتف </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM agents ORDER BY id DESC");
                                    $stmt->execute();
                                    $allrecord = $stmt->fetchAll();
                                    $i = 0;
                                    foreach ($allrecord as $record) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo  $record['name']; ?> </td>
                                            <td> <?php echo  $record['address']; ?> </td>
                                            <td> <?php echo  $record['address_info']; ?> </td>
                                            <td> <?php echo  $record['phone']; ?> </td>

                                            <td>
                                                <button type="button" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#edit-Modal_<?php echo $record['id']; ?>"> تعديل <i class='fa fa-pen'></i> </button>
                                                <a href="main.php?dir=home_page/agent&page=delete&request_id=<?php echo $record['id']; ?>" class="confirm btn btn-danger btn-sm"> حذف <i class='fa fa-trash'></i> </a>
                                            </td>
                                        </tr>
                                        <!-- EDIT NEW CATEGORY MODAL   -->
                                        <div class="modal fade" id="edit-Modal_<?php echo $record['id']; ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> تعديل البطاقة </h4>
                                                    </div>
                                                    <form method="post" action="main.php?dir=home_page/agent&page=edit" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type='hidden' name="agent_id" value="<?php echo $record['id']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> اسم الوكيل </label>
                                                                <input required type="text" class="form-control" name="name" value="<?php echo $record['name'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> العنوان </label>
                                                                <input required type="text" class="form-control" name="address" value="<?php echo $record['address'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> العنوان بالتفصيل</label>
                                                                <input required type="text" class="form-control" name="address_info" value="<?php echo $record['address_info'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> رقم الهاتف </label>
                                                                <input required type="text" class="form-control" name="phone" value="<?php echo $record['phone'] ?>">
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
                                <h4 class="modal-title"> أضافة وكيل </h4>
                            </div>
                            <form action="main.php?dir=home_page/agent&page=add" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name"> اسم الوكيل </label>
                                        <input required type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> العنوان </label>
                                        <input required type="text" class="form-control" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> العنوان بالتفصيل</label>
                                        <input required type="text" class="form-control" name="address_info">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رقم الهاتف </label>
                                        <input required type="text" class="form-control" name="phone">
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