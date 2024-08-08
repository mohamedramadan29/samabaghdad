<?php

$stmt = $connect->prepare("SELECT * FROM index_page");
$stmt->execute();
$indexdata = $stmt->fetch();
$top_nav_text = $indexdata['top_nav_text'];
$facebook_link = $indexdata['facebook_link'];
$whastapp_link    = $indexdata['whastapp_link'];
$logo = $indexdata['logo'];
$news_desc = $indexdata['news_desc'];
?>
<div class="large_screen">
    <div class="top_header">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="top1 text-right">
                        <span class="date"> <?php echo $top_nav_text; ?> </span>
                    </div>
                    <!-- <div class="slider_news" style="width: 75%;">
                        <span class="news"> <?php echo $news_desc; ?> </span>
                    </div> -->
                    <div class="top2">
                        <ul class="list-unstyled">
                            <li> <a href="<?php echo $facebook_link; ?>"> <i class="bi bi-facebook"></i> </a> </li>
                            <li> <a href="<?php echo $whatsapp_link; ?>"> <i class="bi bi-whatsapp"></i> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light navigation">
                        <a class="navbar-brand" href="index">
                            <img width="130px" src="admin/home_page/uploads/<?php echo $logo; ?>" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav ">
                                <li class="nav-item">
                                    <a class="nav-link" id='index_link' aria-current="page" href="index"> الرئيسية </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="western_link" href="westernunion"> إرسال الأموال مع WESTERN UNION أونلاين </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="dollar_link" href="dollar"> حجز دولار للمسافرين </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account_link" href="accounts"> حسابات المنصة </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>

<div class="small_screen">
    <div class="top_header" dir="rtl">
        <div class="container-fluid">
            <div class="top1 text-center">
                <span class="date"> <?php echo $top_nav_text; ?> </span>
            </div>
            <!-- <div class="news_section" style="display: flex;">
                <div class="nots">
                    <span>   إنتباه  </span>
                </div>
                <div class="slider_news">
                    <div class="news"> <?php  echo $news_desc;?> </div>
                </div>
            </div> -->

        </div>
    </div>
    <div class="top_header medieum" dir="rtl">
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div class="top2">
                        <div>
                            <a class="navbar-brand" href="index">
                                <img width="100px" src="admin/home_page/uploads/<?php echo $logo; ?>" alt="">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <ul class="list-unstyled">
                                <li> <a href="<?php echo $facebook_link; ?>"> <i class="fa fa-facebook"></i> </a> </li>
                                <li> <a href="<?php echo $whastapp_link; ?>"> <i class="fa fa-whatsapp"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="last_header">
        <nav class="navbar navbar-expand-lg navbar-light navigation">
            <div class="new_links">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index"> الرئيسية </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="westernunion"> إرسال الأموال مع WESTERN UNION أونلاين </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dollar"> حجز دولار للمسافرين </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accounts"> حسابات المنصة </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get current page from URL
        const path = window.location.pathname.split("/").pop();

        // Select all nav links
        const navLinks = document.querySelectorAll('.nav-link');

        // Loop through each nav link
        navLinks.forEach(link => {
            // Get the href attribute of the link
            const href = link.getAttribute('href');

            // Check if the href matches the current path
            if (path === href) {
                // Add 'active' class to the matching link
                link.classList.add('active');
            }
        });
    });
</script>
<style>
    .small_screen {
        /* margin: 0;
        padding: 0; */
    }

    .small_screen .top_header {
        /* padding: 0;
        margin: 0; */

    }

    .small_screen .top_header .container-fluid {

    }

    .news_section {
        display: flex;
        align-items: center;
        padding-top: 5px;
        padding-bottom: 5px;

    }
    .news_section .nots{
       
    }

    .news_section span {
        background-color: red;
        font-weight: bold;
        color: #fff;
        display: inline-block;
        padding: 5px 5px;
        font-size: 14px;
    }

    .slider_news {
        overflow: hidden;
        position: relative;
    }
 

    .slider_news .news {
        display: inline-block;
        animation: slide 15s linear infinite;
        white-space: nowrap;
    }

    @keyframes slide {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function marquee() {
            $('.slider_news .news').animate({
                left: '100%'
            }, 1500, 'linear', function() {
                $(this).css('left', '-100%');
                marquee();
            });
        }
        marquee();
    });
</script>