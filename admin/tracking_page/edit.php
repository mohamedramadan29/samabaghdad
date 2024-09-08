<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> صفحة متابعة الطلب </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> صفحة متابعة الطلب  </li>
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
                    $stmt = $connect->prepare("SELECT * FROM tracking_page");
                    $stmt->execute();
                    $indexdata = $stmt->fetch();
                    $desc = $indexdata['desc'];  
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="card-body"> 
                                    <div class="form-group">
                                        <label for="name"> محتوي الصفحه   </label>
                                        <textarea name="desc" class="form-control summernote" id=""><?php echo $desc ?></textarea>
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

        $desc = $_POST['desc'];
        $stmt = $connect->prepare("UPDATE tracking_page SET `desc` = ? ");
        $stmt->execute(array($desc));
        if ($stmt) {
            header('Location:main?dir=tracking_page&page=edit');
        }
    } catch (\Exception $e) {
        echo $e;
    }
}

?>