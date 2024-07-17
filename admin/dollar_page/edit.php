<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> صفحة حجز دولار للمسافرين </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> صفحة حجز دولار للمسافرين </li>
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
                    $stmt = $connect->prepare("SELECT * FROM dollar_page");
                    $stmt->execute();
                    $indexdata = $stmt->fetch();

                    $banner_image = $indexdata['banner_image'];
                    $title1 = $indexdata['title1'];
                    $desc1 = $indexdata['desc1'];
                    $amount = $indexdata['amount'];
                    $recieve_dollar     = $indexdata['recieve_dollar'];




                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="card-body">
                                    <h4 class="badge badge-info"> البانر </h4>
                                    <div class="form-group">
                                        <label for=""> البانر </label>
                                        <input type="file" name="logo" class="form-control">
                                        <img width="80px" height="80px" class="product-img img-bordered" src="dollar_page/uploads/<?php echo $banner_image; ?>" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> العنوان </label>
                                        <input type="text" class="form-control" name="title1" class="form-control" value="<?php echo $title1; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> الشروط والأحكام </label>
                                        <textarea name="desc1" class="form-control summernote" id=""><?php echo $desc1 ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> المبلغ </label>
                                        <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> اماكن استلام الدولار <span class="badge badge-danger"> افصل بين كل مكان والاخر ب (,) </span> </label>
                                        <textarea name="recieve_dollar" class="form-control" rows="8" id=""><?php echo $recieve_dollar ?></textarea>
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

        $banner_image = $_POST['banner_image'];
        $title1 = $_POST['title1'];
        $desc1 = $_POST['desc1'];
        $amount = $_POST['amount'];
        $recieve_dollar     = $_POST['recieve_dollar'];

        // // update Logo
        if (!empty($_FILES['logo']['name'])) {
            $logo_name = $_FILES['logo']['name'];
            $logo_name = str_replace(' ', '-', $logo_name);
            $logo_temp = $_FILES['logo']['tmp_name'];
            $logo_type = $_FILES['logo']['type'];
            $logo_size = $_FILES['logo']['size'];
            $logo_uploaded = time() . '_' . $logo_name;
            $upload_path = 'dollar_page/uploads/' . $logo_uploaded;
            move_uploaded_file($logo_temp, $upload_path);
        }
        $stmt = $connect->prepare("UPDATE dollar_page SET title1=? ,desc1=?,amount=? ,recieve_dollar=?");
        $stmt->execute(array($title1, $desc1, $amount,$recieve_dollar));
        
        // update Logo 
        if (!empty($_FILES['logo']['name'])) {
            $stmt = $connect->prepare("UPDATE dollar_page SET banner_image=?");
            $stmt->execute(array(
                $logo_uploaded,
            ));
        }
        if ($stmt) {
            header('Location:main?dir=dollar_page&page=edit');
        }
    } catch (\Exception $e) {
        echo $e;
    }
}

?>