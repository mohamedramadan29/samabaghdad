<?php
$order_id = $_GET['order_id'];
$stmt = $connect->prepare("SELECT * FROM dollar WHERE id = ?");
$stmt->execute(array($order_id));
$order_data = $stmt->fetch();
$name = $order_data['dollar_name'];
$date = $order_data['created_at'];
$travel_date = $order_data['travel_date'];
$order_number = $order_data['order_number'];
$serv_name = ' شراء الدولار لأغراض السفر  ';
$travel_to = $order_data['travel_to'];
$branch = $order_data['where_receieve_dollar'];
$amount = $order_data['dollar_amount'];
$order_step = $order_data['step_number'];
?>

<div class="print">
    <div class="data">
        <img src="../uploads/sama_logo.jpeg" alt="">
        <div class="info">
            <br>
            <p class="text-center" style="font-weight: bold;"> شراء الدولار لاغراض السفر </p>
            <table class="table table-bordered table-striped">
                <tr>
                    <input type="hidden" id="customername" value="<?php echo $name ?>">
                    <th style="color: #27ae60;"> الاسم كامل </th>
                    <td> <?php echo $name ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> التاريخ </th>
                    <td> <?php echo $date ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> رقم الحجز </th>
                    <td> <?php echo $order_number ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> رقم الدور </th>
                    <td> <?php
                            echo $order_step;
                            ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> الخدمة </th>
                    <td> <?php echo $serv_name ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> تاريخ السفر </th>
                    <td> <?php echo $travel_date ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> بلد الوجهة </th>
                    <td> <?php echo $travel_to ?> </td>
                </tr>
                <tr>
                    <th style="color: #27ae60;"> الفرع </th>
                    <td> <?php echo $branch ?> </td>
                </tr>

                <tr>
                    <th style="color: #27ae60;"> المبلغ </th>
                    <td> <?php echo $amount ?> </td>
                </tr>
            </table>
            <p style="color: #27ae60; font-weight:bold"> الرجاء الالتزام بالحضور وفقا لرقم الحجز </p>
        </div>
        <button id="print_Button" onclick="setPrintTitle(); window.print(); return false;" class="btn btn-primary"> طباعة الطلب <i class="fa fa-print"></i> </button>
    </div>

</div>

<style>
    .print {
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

<script>
    function setPrintTitle() {
        // تعيين عنوان مخصص للصفحة ليتم طباعته
        document.title = document.getElementById('customername').value;

        // التأكد من أن العنوان الجديد قد تم تعيينه بشكل صحيح
        console.log("تم تعيين عنوان مخصص للطباعة: " + document.title);

        // إضافة استماع لحدث اكتمال الطباعة لاستعادة العنوان الأصلي بعد الطباعة
        window.onafterprint = function() {
            document.title = document.getElementById('customername').value;
            console.log("استعادة عنوان الصفحة الأصلي: " + document.title);
        };
    }
</script>