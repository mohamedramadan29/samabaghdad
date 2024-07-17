<?php
// get the account details 

if (isset($_GET['account_id'])) {
    $account_id = $_GET['account_id'];
    $stmt = $connect->prepare("SELECT * FROM accounts WHERE id = ?");
    $stmt->execute(array($account_id));
    $account_data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $account_number = $account_data['account_number'];
        $all_price = $account_data['all_price'];
        $current_balance = $account_data['current_balance'];
    } else {
        header("Location:index");
    }
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> تفاصيل الحساب رقم <span class="badge badge-primary"> <?php echo $account_number; ?> </span> </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> تفاصيل الحساب </li>
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
                        <button type="button" class="btn btn-primary waves-effect btn-sm" data-toggle="modal" data-target="#add-Modal"> اضافة حركة جديدة <i class="fa fa-plus"></i> </button>
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
                                        <th> رقم الحساب </th>
                                        <th> مبلغ الايداع </th>
                                        <th> تاريخ الايداع </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM account_details WHERE account_id = ? ORDER BY id DESC");
                                    $stmt->execute(array($account_id));
                                    $allrecord = $stmt->fetchAll();
                                    $i = 0;
                                    $total_paid_amount = 0;
                                    foreach ($allrecord as $record) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo  $account_number ?> </td>
                                            <td> <?php echo  $record['price_amount']; ?> </td>
                                            <td> <?php echo  $record['price_date']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#edit-Modal_<?php echo $record['id']; ?>"> تعديل <i class='fa fa-pen'></i> </button>
                                                <a href="main.php?dir=acounts_details&page=delete&request_id=<?php echo $record['id']; ?>" class="confirm btn btn-danger btn-sm"> حذف <i class='fa fa-trash'></i> </a>
                                            </td>
                                        </tr>
                                        <!-- EDIT NEW CATEGORY MODAL   -->
                                        <div class="modal fade" id="edit-Modal_<?php echo $record['id']; ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> تعديل الايداع </h4>
                                                    </div>
                                                    <form method="post" action="main?dir=acounts_details&page=edit" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type='hidden' name="account_details_id" value="<?php echo $record['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="name"> رقم الحساب </label>
                                                                <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                                                                <input type="hidden" name="total_price" value="<?php echo $all_price; ?>">
                                                                <input required readonly type="text" class="form-control" name="account_number" value="<?php echo $account_number; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> قيمة الايداع </label>
                                                                <input required type="number" class="form-control" name="price_amount" value="<?php echo $record['price_amount'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name"> تاريخ الايداع </label>
                                                                <input required type="date" class="form-control" name="price_date" value="<?php echo $record['price_date'] ?>">
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
                                        $total_paid_amount = $total_paid_amount + $record['price_amount'];
                                    }
                                    ?>
                                    <?php echo $total_paid_amount; ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" style="background-color: #2980b9; color:#fff"> مبلغ الايداع الكلي </th>
                                        <th colspan="3"> <?php echo number_format($total_paid_amount, 2)  ?> </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="background-color: #2980b9; color:#fff"> الرقم المطلوب </th>
                                        <th colspan="3"> <?php echo number_format($all_price, 2); ?> </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="background-color: #2980b9; color:#fff"> الباقي </th>
                                        <th colspan="3" style="background-color: #e74c3c; color:#fff">
                                            <?php
                                            $remind_amount = $all_price - $total_paid_amount;
                                            echo number_format($remind_amount, 2); ?> </th>
                                    </tr>
                                    <tr>
                                        <th colspan='2' style="background-color: #2980b9; color:#fff"> الرصيد الحالي </th>
                                        <th colspan="3" style="background-color: #f1c40f; color:#fff">
                                            <?php echo $current_balance ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ADD NEW CATEGORY MODAL   -->
                <div class="modal fade" id="add-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> اضافة حركة جديدة علي الحساب </h4>
                            </div>
                            <form action="main?dir=acounts_details&page=add" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name"> رقم الحساب </label>
                                        <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                                        <input type="hidden" name="total_price" value="<?php echo $all_price; ?>">
                                        <input required readonly type="text" class="form-control" name="account_number" value="<?php echo $account_number; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> قيمة الايداع </label>
                                        <input required type="number" class="form-control" name="price_amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> تاريخ الايداع </label>
                                        <input required type="date" class="form-control" name="price_date">
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