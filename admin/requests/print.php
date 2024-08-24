<?php
$request_id = $_GET['request_id'];
$stmt = $connect->prepare("SELECT * FROM requests WHERE id = ?");
$stmt->execute(array($request_id));
$request_data = $stmt->fetch();
$name = $request_data['name'];
$price_request = $request_data['price_request'];
$city = $request_data['city'];
$phone = $request_data['phone'];
$request_order = $request_data['request_order'];
$status = $request_data['status'];
?>

<div class="print">
    <div class="data">
        <img src="../uploads/logo.png" alt="">
        <div class="info">
            <h2> مرحبا <span><?php echo $name ?></span> </h2>
            <p> شكرا لطلبك </p>
            <table class="table table-bordered table-striped">
                <tr>
                    <th> الأسم  </th>
                    <td> <?php echo $name ?> </td>
                </tr>
                <tr>
                    <th>  المبلغ المطلوب   </th>
                    <td>  <?php echo $price_request ?>  </td>
                </tr>
                <tr>
                    <th> المحافظة  </th>
                    <td>  <?php echo $city ?>  </td>
                </tr>
                <tr>
                    <th>  رقم الهاتف   </th>
                    <td>  <?php echo $phone ?>  </td>
                </tr>
                <tr>
                    <th> تاريخ الأستلام   </th>
                    <td>  <?php echo $request_order ?>  </td>
                </tr>
            </table>
        </div>
        <button id="print_Button" onclick="window.print(); return false;" class="btn btn-primary"> طباعة الطلب <i class="fa fa-print"></i> </button>
    </div>
   
</div>

<style>
    .print{
        background-color: #fff;
    }
    .print .data {
        background-color: #fff;
        max-width: 80%;
        margin: auto;
        box-shadow: 0px 0px 10px #e1e1e1;
        border-radius: 10px;
        padding: 30px;
    }

    .print .data img {
        text-align: center;
        max-width: 200px;
        margin: auto;
        display: block;
    }

    @media print {

        .footer,
        .bottom_footer,
        .main_navbar,
        .instagrame_footer {
            display: none !important;
        }

        .print_order {
            max-width: 100% !important;
            padding: 10px !important;
        }

        body {
            background-color: #fff;
        }

        #print_Button {
            display: none !important;
        }

        .print-link {
            display: none !important;
        }

        @page {
            margin: 0;
        }

        body {
            margin: 1.6cm;
        }
    }
</style>