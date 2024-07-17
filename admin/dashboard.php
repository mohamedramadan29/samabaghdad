<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"> الرئيسية </h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
          <li class="breadcrumb-item active"> مسا بغداد للصرافة  </li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <?php
        $stmt = $connect->prepare("SELECT * FROM western");
        $stmt->execute();
        $allrows = count($stmt->fetchAll());
        ?>
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $allrows; ?></h3>
            <p class="text-bold">  طلبات ارسال الاموال مع ويسترن  </p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="main.php?dir=wester_orders&page=report" class="small-box-footer"> التقاصيل <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <?php
        $stmt = $connect->prepare("SELECT * FROM dollar");
        $stmt->execute();
        $allrows = count($stmt->fetchAll());
        ?>
        <div class="small-box bg-warning">
          <div class="inner">
            <h3> <?php echo $allrows ?> </h3>

            <p class="text-bold"> طلبات حجز دولار المسافرين  </p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="main.php?dir=dollar_orders&page=report" class="small-box-footer"> التقاصيل <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <br>
  </div>
</section>
</div>