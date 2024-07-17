<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> الصفحة الرئيسية </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> التحكم في الصفحة الرئيسية </li>
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
                    $stmt = $connect->prepare("SELECT * FROM index_page");
                    $stmt->execute();
                    $indexdata = $stmt->fetch();

                    $top_nav_text = $indexdata['top_nav_text'];
                    $facebook_link = $indexdata['facebook_link'];
                    $whastapp_link = $indexdata['whastapp_link'];
                    $logo = $indexdata['logo'];
                    $hero_first_title = $indexdata['hero_first_title'];
                    $hero_title = $indexdata['hero_title'];
                    $hero_desc = $indexdata['hero_desc'];
                    $hero_b_one = $indexdata['hero_b_one'];
                    $hero_b1_link = $indexdata['hero_b1_link'];
                    $hero_b_two = $indexdata['hero_b_two'];
                    $hero_b2_link = $indexdata['hero_b2_link'];
                    $sec2_title = $indexdata['sec2_title'];
                    $sec2_desc = $indexdata['sec2_desc'];
                    $sec2_image = $indexdata['sec2_image'];
                    $sec2_b = $indexdata['sec2_b'];
                    $sec2_b_link = $indexdata['sec2_b_link'];
                    $banner_image = $indexdata['banner_image'];
                    $serv_title = $indexdata['serv_title'];
                    $last_title = $indexdata['last_title'];
                    $footer_text = $indexdata['footer_text'];




                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="card-body">
                                    <h4 class="badge badge-info"> الناف العلوي </h4>
                                    <div class="form-group">
                                        <label for=""> النص </label>
                                        <input type="text" class="form-control" name="top_nav_text" class="form-control" value="<?php echo $top_nav_text; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رابط الفيسبوك</label>
                                        <input type="text" class="form-control" name="facebook_link" value="<?php echo $facebook_link; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رابط الوتساب</label>
                                        <input type="text" class="form-control" name="whastapp_link" value="<?php echo $whastapp_link; ?>">
                                    </div>
                                    <h4 class="badge badge-info"> خصائص اللوجو </h4>
                                    <div class="form-group">
                                        <label for=""> اللوجو </label>
                                        <input type="file" name="logo" class="form-control">
                                        <img width="80px" height="80px" class="product-img img-bordered" src="home_page/uploads/<?php echo $logo; ?>" alt="">
                                    </div>
                                    <h4 class="badge badge-info"> القسم الاول </h4>
                                    <div class="form-group">
                                        <label for="name"> العنوان الفرعي </label>
                                        <input type="text" class="form-control" name="hero_first_title" value="<?php echo $hero_first_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> العنوان </label>
                                        <input type="text" class="form-control" name="hero_title" value="<?php echo $hero_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> الوصف </label>
                                        <input type="text" class="form-control" name="hero_desc" value="<?php echo $hero_desc; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> نص الزر الاول </label>
                                        <input type="text" class="form-control" name="hero_b_one" value="<?php echo $hero_b_one; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رابط الزر الاول </label>
                                        <input type="text" class="form-control" name="hero_b1_link" value="<?php echo $hero_b1_link; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> نص الزر الثاني </label>
                                        <input type="text" class="form-control" name="hero_b_two" value="<?php echo $hero_b_two; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رابط الزر الثاني </label>
                                        <input type="text" class="form-control" name="hero_b2_link" value="<?php echo $hero_b2_link; ?>">
                                    </div>
                                    <h4 class="badge badge-info"> القسم الثاني </h4>

                                    <div class="form-group">
                                        <label for="name"> العنوان </label>
                                        <input type="text" class="form-control" name="sec2_title" value="<?php echo $sec2_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> الوصف </label>
                                        <input type="text" class="form-control" name="sec2_desc" value="<?php echo $sec2_desc; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> نص الزر </label>
                                        <input type="text" class="form-control" name="sec2_b" value="<?php echo $sec2_b; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> رابط الزر </label>
                                        <input type="text" class="form-control" name="sec2_b_link" value="<?php echo $sec2_b_link; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for=""> الصورة </label>
                                        <input type="file" name="section_two_background" class="form-control">
                                        <img width="80px" height="80px" class="product-img img-bordered" src="home_page/uploads/<?php echo $sec2_image; ?>" alt="">
                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card-body">

                                    <h4 class="badge badge-info"> القسم الثالث </h4>

                                    <div class="form-group">
                                        <label for=""> البانر </label>
                                        <input type="file" name="section_three_image" class="form-control">
                                        <img width="80px" height="80px" class="product-img img-bordered" src="home_page/uploads/<?php echo $banner_image ?>" alt="">
                                    </div>

                                    <h4 class="badge badge-info"> القسم الرابع </h4>


                                    <div class="form-group">
                                        <label for="name"> العنوان </label>
                                        <input type="text" class="form-control" name="serv_title" value="<?php echo $serv_title; ?>">
                                    </div>

                                    <div class="form-group">
                                        <a href="main.php?dir=home_page/services&page=report" class="btn btn-warning" target="_blank"> يمكن ادخال الخدمات من هنا </a>
                                    </div>

                                    <h4 class="badge badge-info"> القسم الخامس </h4>

                                    <div class="form-group">
                                        <label for="name"> العنوان </label>
                                        <input type="text" class="form-control" name="last_title" value="<?php echo $last_title; ?>">
                                    </div>


                                    <h4 class="badge badge-info"> الفوتر </h4>

                                    <div class="form-group">
                                        <label for="name"> عنوان الحقوق </label>
                                        <input type="text" class="form-control" name="footer_text" value="<?php echo $footer_text; ?>">
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

        $top_nav_text = $_POST['top_nav_text'];
        $facebook_link = $_POST['facebook_link'];
        $whastapp_link = $_POST['whastapp_link'];
        $logo = $_POST['logo'];
        $hero_first_title = $_POST['hero_first_title'];
        $hero_title = $_POST['hero_title'];
        $hero_desc = $_POST['hero_desc'];
        $hero_b_one = $_POST['hero_b_one'];
        $hero_b1_link = $_POST['hero_b1_link'];
        $hero_b_two = $_POST['hero_b_two'];
        $hero_b2_link = $_POST['hero_b2_link'];
        $sec2_title = $_POST['sec2_title'];
        $sec2_desc = $_POST['sec2_desc'];
        $sec2_image = $_POST['sec2_image'];
        $sec2_b = $_POST['sec2_b'];
        $sec2_b_link = $_POST['sec2_b_link'];
        $banner_image = $_POST['banner_image'];
        $serv_title = $_POST['serv_title'];
        $last_title = $_POST['last_title'];
        $footer_text = $_POST['footer_text'];

        // // update Logo
        if (!empty($_FILES['logo']['name'])) {
            $logo_name = $_FILES['logo']['name'];
            $logo_name = str_replace(' ', '-', $logo_name);
            $logo_temp = $_FILES['logo']['tmp_name'];
            $logo_type = $_FILES['logo']['type'];
            $logo_size = $_FILES['logo']['size'];
            $logo_uploaded = time() . '_' . $logo_name;
            $upload_path = 'home_page/uploads/' . $logo_uploaded;
            move_uploaded_file($logo_temp, $upload_path);
        }
        // // update section two background
        if (!empty($_FILES['section_two_background']['name'])) {
            $section_two_background_name = $_FILES['section_two_background']['name'];
            $section_two_background_name = str_replace(' ', '-', $section_two_background_name);
            $section_two_background_temp = $_FILES['section_two_background']['tmp_name'];
            $section_two_background_type = $_FILES['section_two_background']['type'];
            $section_two_background_size = $_FILES['section_two_background']['size'];
            $section_two_background_uploaded = time() . '_' . $section_two_background_name;
            $upload_path = 'home_page/uploads/' . $section_two_background_uploaded;
            move_uploaded_file($section_two_background_temp, $upload_path);
        }
        // // update section Three Main Image
        if (!empty($_FILES['section_three_image']['name'])) {
            $section_three_image_name = $_FILES['section_three_image']['name'];
            $section_three_image_name = str_replace(' ', '-', $section_three_image_name);
            $section_three_image_temp = $_FILES['section_three_image']['tmp_name'];
            $section_three_image_type = $_FILES['section_three_image']['type'];
            $section_three_image_size = $_FILES['section_three_image']['size'];
            $section_three_image_uploaded = time() . '_' . $section_three_image_name;
            $upload_path = 'home_page/uploads/' . $section_three_image_uploaded;
            move_uploaded_file($section_three_image_temp, $upload_path);
        }


        $stmt = $connect->prepare("UPDATE index_page SET top_nav_text=? ,facebook_link=?, whastapp_link=? ,hero_first_title=? ,hero_title=?
                                ,hero_desc=? ,hero_b_one=? ,hero_b1_link=? ,hero_b_two=? ,hero_b2_link=? ,sec2_title =?,sec2_desc=?
                                ,sec2_b =?,sec2_b_link=? ,serv_title=? ,last_title=? ,footer_text=?");
        $stmt->execute(array(
            $top_nav_text, $facebook_link, $whastapp_link,
            $hero_first_title,  $hero_title, $hero_desc,  $hero_b_one,
            $hero_b1_link,  $hero_b_two, $hero_b2_link,  $sec2_title, $sec2_desc,
            $sec2_b,   $sec2_b_link,
            $serv_title, $last_title,  $footer_text,
        ));
        // update section two background
        if (!empty($_FILES['section_two_background']['name'])) {
            $stmt = $connect->prepare("UPDATE index_page SET sec2_image=?");
            $stmt->execute(array(
                $section_two_background_uploaded,
            ));
        }
        // update section three main image
        if (!empty($_FILES['section_three_image']['name'])) {
            $stmt = $connect->prepare("UPDATE index_page SET banner_image=?");
            $stmt->execute(array(
                $section_three_image_uploaded,
            ));
        }
        // update Logo 
        if (!empty($_FILES['logo']['name'])) {
            $stmt = $connect->prepare("UPDATE index_page SET logo=?");
            $stmt->execute(array(
                $logo_uploaded,
            ));
        }
        if ($stmt) {
            header('Location:main?dir=home_page&page=edit');
        }
    } catch (\Exception $e) {
        echo $e;
    }
}

?>