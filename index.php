<?php
ob_start();
session_start();
include 'init.php';
$stmt = $connect->prepare("SELECT * FROM index_page");
$stmt->execute();
$indexdata = $stmt->fetch();
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
<div id="page-content">
    <div class="hero">
        <div class="container">
            <div class="data">
                <button data-aos="fade-up"> <?php echo $hero_first_title ?> </button>
                <h4 data-aos="fade-up"> <?php echo $hero_title ?> </h4>
                <p data-aos="fade-up"> <?php echo $hero_desc ?> </p>
                <div class="buttons">
                    <a data-aos="fade-up" href="<?php echo $hero_b1_link ?>" class="btn btn1"> <?php echo $hero_b_one ?> <i class="fa fa-dollar"></i> </a>
                    <a data-aos="fade-up" href="<?php echo $hero_b2_link ?>" class="btn btn2"> <?php echo $hero_b_two ?><i class="fa fa-hand-holding-usd"></i> </a>
                </div>
            </div>
        </div>
    </div>

    <div class="western">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="info">
                        <h2> <?php echo $sec2_title  ?></h2>
                        <p> <?php echo $sec2_desc ?> </p>
                        <a href="<?php echo $sec2_b_link; ?>" class="btn"> <?php echo $sec2_b ?> </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="wester_image">
                        <img src="admin/home_page/uploads/<?php echo $sec2_image; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="recieve_dollar_banner">
        <a href="dollar">
            <img src="admin/home_page/uploads/<?php echo $banner_image; ?>" alt="">
        </a>
    </div> -->
    <div class="services">
        <div class="container">
            <h2> <?php echo $serv_title; ?> </h2>
            <div class="row">
                <?php

                $stmt = $connect->prepare("SELECT * FROM services");
                $stmt->execute();
                $allserv = $stmt->fetchAll();
                foreach ($allserv as $serv) {
                ?>
                    <div class="col-lg-4 col-12">
                        <div class="info" data-aos="fade-up">
                            <img src="admin/home_page/services/uploads/<?php echo $serv['image']; ?>" alt="">
                            <h4> <?php echo $serv['title'] ?> </h4>
                            <p> <?php echo $serv['description']; ?></p>
                        </div>
                    </div>
                <?php
                }
                ?> 
            </div>
        </div>
    </div>

    <div class="last_hero">
        <div class="container">
            <div class="data">
                <img src="admin/home_page/uploads/<?php echo $logo; ?>" alt="">
                <p> <?php echo $last_title; ?> </p>
            </div>
        </div>
    </div>
</div>

<?php
include $tem . 'footer.php';
ob_end_flush();
?>