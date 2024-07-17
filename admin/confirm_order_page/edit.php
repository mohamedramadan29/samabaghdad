<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> صفحة تاكيد الطلب </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> صفحة تاكيد الطلب </li>
                </ol>
            </div>
        </div>
    </div>
</section>
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
                    <!-- Get The All Data In the Index Page -->
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM confirm_page");
                    $stmt->execute();
                    $indexdata = $stmt->fetch();

                    $title = $indexdata['title'];
                    $title2 = $indexdata['title2'];
                    $desc1 = $indexdata['desc1'];
                    $desc2 = $indexdata['desc2'];




                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="card-body">
                                    <h4 class="badge badge-info"> العناوين </h4>
                                    <div class="form-group">
                                        <label for=""> العنوان الاول </label>
                                        <input type="text" class="form-control" name="title" class="form-control" value="<?php echo $title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> العنوان الثاني </label>
                                        <input type="text" class="form-control" name="title2" class="form-control" value="<?php echo $title2; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> الملعومات القسم الاول ( فوق التاكيد  </label>
                                        <textarea name="desc1" class="form-control summernote" id=""><?php echo $desc1 ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> الملعومات القسم الثاني ( اسفل التاكيد ) </label>
                                        <textarea name="desc2" class="form-control summernote" id=""><?php echo $desc2 ?></textarea>
                                    </div> 

                                    <div class="modal-footer">
                                        <button type="submit" name="edit_home" class="btn btn-primary waves-effect waves-light "> حفظ </button>
                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal"> رجوع </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php
if (isset($_POST['edit_home'])) {
    try {

        $title = $_POST['title'];
        $title2 = $_POST['title2'];
        $desc1 = $_POST['desc1'];
        $desc2 = $_POST['desc2'];

        $stmt = $connect->prepare("UPDATE confirm_page SET title=?,title2=? ,desc1=?,desc2=?");
        $stmt->execute(array(
            $title,$title2,$desc1,$desc2
        ));
        if ($stmt) {
            header('Location:main?dir=confirm_order_page&page=edit');
        }
    } catch (\Exception $e) {
        echo $e;
    }
}

?>