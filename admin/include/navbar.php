    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav mr-auto">
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="main.php?dir=dashboard&page=dashboard" class="brand-link">
        <span class="brand-text font-weight-light"> سما </span>
        <img src="uploads/sama_logo.jpeg" alt="AdminLTE Logo" class="brand-image elevation-3" style="box-shadow: none;">
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="uploads/sama_logo.jpeg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo  $_SESSION['admin_username']; ?> </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="main.php?dir=dashboard&page=dashboard" class="nav-link">
                <p>
                  الرئيسية
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?dir=wester_orders&page=report" class="nav-link">
                <p>
                  طلبات ارسال الاموال مع ويسترن
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?dir=dollar_orders&page=report" class="nav-link">
                <p>
                  طلبات حجز دولار المسافرين
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?dir=profile&page=report" class="nav-link">
                <p>
                  حسابي
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الصفحة الرئيسية
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=home_page&page=edit" class="nav-link">
                    <p> التحكم في الرئيسية </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=offers&page=report" class="nav-link">
                    <p> عروضنا </p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  صفحة ويسترن
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=western_page&page=edit" class="nav-link">
                    <p> التحكم في صفحة ويسترن </p>
                  </a>
                  <a href="main.php?dir=western_page/wester_box&page=report" class="nav-link">
                    <p> خدمات او معلومات ويسترن </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  صفحة حجز دولار للمسافرين
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=dollar_page&page=edit" class="nav-link">
                    <p> صفحة حجز دولار للمسافرين </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  صفحة تاكيد الطلب
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=confirm_order_page&page=edit" class="nav-link">
                    <p> صفحة تاكيد الطلب </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="logout" class="nav-link" style="color: #e74c3c;">
                <p>
                  تسجيل خروج
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>