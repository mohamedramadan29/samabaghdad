<?php
ob_start();
$pagetitle = 'Home';
session_start();
include 'init.php';

if (isset($_SESSION['admin_username'])) {
    include 'include/navbar.php';
} else {
    header("Location:index");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
    $page = '';
    if (isset($_GET['page']) && isset($_GET['dir'])) {
        $page = $_GET['page'];
        $dir = $_GET['dir'];
    } else {
        $page = 'manage';
    }
    // start Website Routes 
    // STRAT DASHBAORD
    if ($dir == 'dashboard' && $page == 'dashboard') {
        include 'dashboard.php';
    } elseif ($dir == 'dashboard' && $page == 'emp_dashboard') {
        include 'emp_dashboard.php';
    }
    // END DASHBAORD
    // START Request
    if ($dir == 'wester_orders' && $page == 'report') {
        include "wester_orders/report.php";
    } elseif ($dir == 'wester_orders' && $page == 'edit') {
        include "wester_orders/edit.php";
    } elseif ($dir == 'wester_orders' && $page == 'delete') {
        include "wester_orders/delete.php";
    }
    // START Dinar Price
    if ($dir == 'dollar_orders' && $page == 'report') {
        include "dollar_orders/report.php";
    } elseif ($dir == 'dollar_orders' && $page == 'edit') {
        include "dollar_orders/edit.php";
    } elseif ($dir == 'dollar_orders' && $page == 'delete') {
        include "dollar_orders/delete.php";
    } elseif ($dir == 'dollar_orders' && $page == 'print') {
        include "dollar_orders/print.php";
    } elseif ($dir == 'dollar_orders' && $page == 'qrcode') {
        include "dollar_orders/qrcode.php";
    }
    // START Profile
    if ($dir == 'profile' && $page == 'add') {
        include "profile/add.php";
    } elseif ($dir == 'profile' && $page == 'edit') {
        include "profile/edit.php";
    } elseif ($dir == 'profile' && $page == 'delete') {
        include 'profile/delete.php';
    } elseif ($dir == 'profile' && $page == 'report') {
        include "profile/report.php";
    }
    // START Home Page
    if ($dir == 'home_page' && $page == 'edit') {
        include "home_page/edit.php";
    } elseif ($dir == 'home_page' && $page == 'report') {
        include "home_page/report.php";
    } elseif ($dir == 'home_page/variable_currancy_se_two' && $page == 'variable_currancy') {
        include "home_page/variable_currancy_se_two/variable_currancy.php";
    } elseif ($dir == 'home_page/variable_currancy_se_two' && $page == 'add') {
        include "home_page/variable_currancy_se_two/add.php";
    } elseif ($dir == 'home_page/variable_currancy_se_two' && $page == 'edit') {
        include "home_page/variable_currancy_se_two/edit.php";
    } elseif ($dir == 'home_page/variable_currancy_se_two' && $page == 'delete') {
        include "home_page/variable_currancy_se_two/delete.php";
    }   ////////////// index services 
    elseif ($dir == 'home_page/services' && $page == 'report') {
        include "home_page/services/report.php";
    } elseif ($dir == 'home_page/services' && $page == 'add') {
        include "home_page/services/add.php";
    } elseif ($dir == 'home_page/services' && $page == 'edit') {
        include "home_page/services/edit.php";
    } elseif ($dir == 'home_page/services' && $page == 'delete') {
        include "home_page/services/delete.php";
    }

    // START Acounts
    if ($dir == 'acounts' && $page == 'add') {
        include "acounts/add.php";
    } elseif ($dir == 'acounts' && $page == 'edit') {
        include "acounts/edit.php";
    } elseif ($dir == 'acounts' && $page == 'delete') {
        include 'acounts/delete.php';
    } elseif ($dir == 'acounts' && $page == 'report') {
        include "acounts/report.php";
    }
    // START Acounts Details
    if ($dir == 'acounts_details' && $page == 'add') {
        include "acounts_details/add.php";
    } elseif ($dir == 'acounts_details' && $page == 'edit') {
        include "acounts_details/edit.php";
    } elseif ($dir == 'acounts_details' && $page == 'delete') {
        include 'acounts_details/delete.php';
    } elseif ($dir == 'acounts_details' && $page == 'report') {
        include "acounts_details/report.php";
    }
    // START Acounts Details
    if ($dir == 'company_info' && $page == 'edit') {
        include "company_info/edit.php";
    } elseif ($dir == 'company_info' && $page == 'report') {
        include "company_info/report.php";
    }


    ///////////////Start Western Page ////////////////// 

    if ($dir == 'western_page' && $page == 'edit') {
        include "western_page/edit.php";
    } elseif ($dir == 'western_page/wester_box' && $page == 'report') {
        include "western_page/wester_box/report.php";
    } elseif ($dir == 'western_page/wester_box' && $page == 'add') {
        include "western_page/wester_box/add.php";
    } elseif ($dir == 'western_page/wester_box' && $page == 'delete') {
        include "western_page/wester_box/delete.php";
    } elseif ($dir == 'western_page/wester_box' && $page == 'edit') {
        include "western_page/wester_box/edit.php";
    } elseif ($dir == 'western_page/westen_payment_method' && $page == 'edit') {
        include "western_page/westen_payment_method/edit.php";
    } elseif ($dir == 'western_page/westen_payment_method' && $page == 'report') {
        include "western_page/westen_payment_method/report.php";
    } elseif ($dir == 'western_page/westen_payment_method' && $page == 'add') {
        include "western_page/westen_payment_method/add.php";
    } elseif ($dir == 'western_page/westen_payment_method' && $page == 'delete') {
        include "western_page/westen_payment_method/delete.php";
    }

    // START  Confirm Page 
    if ($dir == 'confirm_order_page' && $page == 'edit') {
        include "confirm_order_page/edit.php";
    }elseif($dir == 'confirm_order_page' && $page == 'western_confrim'){
        include "confirm_order_page/western_confrim.php";
    }
    //////////// End Confirm Page 

    ////////// Start Dollar Page
    if ($dir == 'dollar_page' && $page == 'edit') {
        include "dollar_page/edit.php";
    }
    /////////// End Dollar Page 


    // START Western
    if ($dir == 'western' && $page == 'add') {
        include "western/add.php";
    } elseif ($dir == 'western' && $page == 'edit') {
        include "western/edit.php";
    } elseif ($dir == 'western' && $page == 'delete') {
        include 'western/delete.php';
    } elseif ($dir == 'western' && $page == 'report') {
        include "western/report.php";
    } elseif ($dir == 'western' && $page == 'print') {
        include "western/print.php";
    }

       // START Request
       if ($dir == 'requests' && $page == 'add') {
        include "requests/add.php";
    } elseif ($dir == 'requests' && $page == 'edit') {
        include "requests/edit.php";
    } elseif ($dir == 'requests' && $page == 'delete') {
        include 'requests/delete.php';
    } elseif ($dir == 'requests' && $page == 'report') {
        include "requests/report.php";
    } elseif ($dir == 'requests' && $page == 'under_report') {
        include "requests/under_report.php";
    } elseif ($dir == 'requests' && $page == 'finish_report') {
        include "requests/finish_report.php";
    } elseif ($dir == 'requests' && $page == 'print') {
        include "requests/print.php";
    } elseif ($dir == 'requests' && $page == 'document') {
        include "requests/document.php";
    } elseif ($dir == 'requests' && $page == 'small_print') {
        include "requests/small_print.php";
    }

    
    // START tracking page
    if ($dir == 'tracking_page' && $page == 'edit') {
        include "tracking_page/edit.php";
    }elseif($dir == 'tracking_page' && $page == 'western_confrim'){
        include "tracking_page/western_confrim.php";
    }
    //////////// End Confirm Page 


    
    ?>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>



<?php
include $tem . "footer.php";
?>