<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> ايصالات ويسترن </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> ايصالات ويسترن </li>
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
                        <button type="button" class="btn btn-primary waves-effect btn-sm" data-toggle="modal" data-target="#add-Modal"> ايضافة ايصال جديد <i class="fa fa-plus"></i> </button>
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
                                        <th> اسم الراسل </th>
                                        <th> اسم المستلم </th>
                                        <th> رقم الحوالة mtcn </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM new_western_accounts ORDER BY id DESC");
                                    $stmt->execute();
                                    $allrecord = $stmt->fetchAll();
                                    $i = 0;
                                    foreach ($allrecord as $record) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo  $record['send_name']; ?> </td>
                                            <td> <?php echo  $record['recieve_name']; ?> </td>
                                            <td> <?php echo  $record['mtcn']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#edit-Modal_<?php echo $record['id']; ?>"> <i class='fa fa-pen'></i> </button>
                                                <a href="main.php?dir=western&page=print&request_id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm"> <i class='fa fa-print'></i> </a>
                                                <a href="main.php?dir=western&page=delete&request_id=<?php echo $record['id']; ?>" class="confirm btn btn-danger btn-sm"> <i class='fa fa-trash'></i> </a>
                                            </td>
                                        </tr>
                                        <!-- EDIT NEW CATEGORY MODAL   -->
                                        <div class="modal fade" id="edit-Modal_<?php echo $record['id']; ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> تعديل الحوالة </h4>
                                                    </div>
                                                    <form method="post" action="main.php?dir=western&page=edit" enctype="multipart/form-data">
                                                        <div class="modal-body d-flex justify-content-between">
                                                            <input type='hidden' name="western_id" value="<?php echo $record['id']; ?>">
                                                            <div class="sender" style="width: 49%;">
                                                                <span class="badge badge-danger"> بيانات الراسل </span>
                                                                <div class="form-group">
                                                                    <label for="name"> الأسم </label>
                                                                    <input required type="text" class="form-control" name="send_name" value="<?php echo $record['send_name'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> رقم الهاتف </label>
                                                                    <input required type="text" class="form-control" name="send_phone" value="<?php echo $record['send_phone'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> العنوان </label>
                                                                    <input required type="text" class="form-control" name="send_address" value="<?php echo $record['send_address'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> id type </label>
                                                                    <input required type="text" class="form-control" name="send_id_type" value="<?php echo $record['send_id_type'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> id Number </label>
                                                                    <input required type="text" class="form-control" name="send_id_number" value="<?php echo $record['send_id_number'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> غرض التحويل </label>
                                                                    <input required type="text" class="form-control" name="send_purpose" value="<?php echo $record['send_purpose'] ?>">
                                                                </div>
                                                                <span class="badge badge-danger"> بيانات التحويل </span>
                                                                <div class="form-group">
                                                                    <label for="name"> Exchange Rate </label>
                                                                    <input required type="text" class="form-control" name="exchange_rate" value="<?php echo $record['exchange_rate'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> PayOut Amount </label>
                                                                    <input required type="text" class="form-control" name="payout_amount" value="<?php echo $record['payout_amount'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> Agent Details </label>
                                                                    <input required type="text" class="form-control" name="agent_details" value="<?php echo $record['agent_details'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="reciever" style="width: 49%;">
                                                                <span class="badge badge-danger"> بيانات المستلم </span>
                                                                <div class="form-group">
                                                                    <label for="name"> الاسم </label>
                                                                    <input required type="text" class="form-control" name="recieve_name" value="<?php echo $record['recieve_name'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> الدولة </label>
                                                                    <input required type="text" class="form-control" name="recieve_country" value="<?php echo $record['recieve_country'] ?>">
                                                                </div>
                                                                <span class="badge badge-danger"> بيانات التحويل </span>
                                                                <div class="form-group">
                                                                    <label for="name"> mtcn </label>
                                                                    <input required type="text" class="form-control" name="mtcn" value="<?php echo $record['mtcn'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> التاريخ </label>
                                                                    <input required type="date" class="form-control" name="date" value="<?php echo $record['date'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> التوقيت </label>
                                                                    <input required type="time" class="form-control" name="time" value="<?php echo $record['time'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> Amount Send </label>
                                                                    <input required type="text" class="form-control" name="amount_send" value="<?php echo $record['amount_send'] ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name"> Fee </label>
                                                                    <input required type="text" class="form-control" name="fee" value="<?php echo $record['fee'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name"> Total </label>
                                                                    <input required type="text" class="form-control" name="total" value="<?php echo $record['total'] ?>">
                                                                </div>
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
                                <h4 class="modal-title"> ايضافة ايصال ويسترن </h4>
                            </div>
                            <form action="main.php?dir=western&page=add" method="post" enctype="multipart/form-data">
                                <div class="modal-body d-flex justify-content-between">
                                    <div class="sender" style="width: 49%;">
                                        <span class="badge badge-danger"> بيانات الراسل </span>
                                        <div class="form-group">
                                            <label for="name"> الأسم </label>
                                            <input required type="text" class="form-control" name="send_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> رقم الهاتف </label>
                                            <input required type="text" class="form-control" name="send_phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> العنوان </label>
                                            <input required type="text" class="form-control" name="send_address">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> id type </label>
                                            <input required type="text" class="form-control" name="send_id_type" value="National Id Card">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> id Number </label>
                                            <input required type="text" class="form-control" name="send_id_number" value="4320******">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> غرض التحويل </label>
                                            <input required type="text" class="form-control" name="send_purpose" value="Family support">
                                        </div>
                                        <span class="badge badge-danger"> بيانات التحويل </span>
                                        <div class="form-group">
                                            <label for="name"> Exchange Rate </label>
                                            <input required type="text" class="form-control" name="exchange_rate">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> PayOut Amount </label>
                                            <input required type="text" class="form-control" name="payout_amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> Agent Details </label>
                                            <input required type="text" class="form-control" name="agent_details">
                                        </div>
                                    </div>
                                    <div class="reciever" style="width: 49%;">
                                        <span class="badge badge-danger"> بيانات المستلم </span>
                                        <div class="form-group">
                                            <label for="name"> الاسم </label>
                                            <input required type="text" class="form-control" name="recieve_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> الدولة </label>
                                            <input required type="text" class="form-control" name="recieve_country" value="IRAQ">
                                        </div>
                                        <span class="badge badge-danger"> بيانات التحويل </span>
                                        <div class="form-group">
                                            <label for="name"> mtcn </label>
                                            <input required type="text" class="form-control" name="mtcn">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> التاريخ </label>
                                            <input required type="date" class="form-control" name="date">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> التوقيت </label>
                                            <input required type="time" class="form-control" name="time">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> Amount Send </label>
                                            <input required type="text" class="form-control" name="amount_send">
                                        </div>

                                        <div class="form-group">
                                            <label for="name"> Fee </label>
                                            <input required type="text" class="form-control" name="fee">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> Total </label>
                                            <input required type="text" class="form-control" name="total">
                                        </div>

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

<style>
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 600px;
            margin: 1.75rem auto;
        }
    }
</style>