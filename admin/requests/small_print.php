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
$request_number = $request_data['request_number'];
$request_time = $request_data['order_time'];

// get the dinar value 
$stmt = $connect->prepare("SELECT * FROM price");
$stmt->execute();
$dinar_data = $stmt->fetch();
$dinar_value = $dinar_data['dinar_price'];
?>

<div class="print">
    <div class="data">
        <img src="../uploads/logo.png" alt="">
        <div class="info">
            <div class="head">
                <h2> شركة البراق للخدمات الماليه </h2>
                <h2 style="font-size: 22px;font-weight: bold;"> الحسابات / قسم التدقيق والصرف </h2>
                <p> العراق - بغداد </p>
                <p> 07832301812 - 07710997820 </p>
            </div>
            <div class="invoice_info">
                <p> مبيع - نقدي </p>
                <hr>
                <h4> رقم الفاتورة - <?php echo $request_number ?> </h4>
                <ul class="list-unstyled">
                    <li> تاريخ الفاتورة : <strong> <?php echo $request_order; ?> </strong> </li>
                    <li> وقت الفاتورة : <strong> <?php echo $request_time; ?> </strong> </li>
                </ul>
            </div>
            <hr>
            <div class="customer_info">
                <p class="customer_name text-center"> السيد : <?php echo $name ?> </p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> اسم المادة </th>
                            <th> العدد </th>
                            <th> الافرادي </th>
                            <th> الاجمالي </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $dollar_number = $price_request / 100;

                            ?>
                            <td> Dollar LB - دولار LB </td>
                            <td> <?php echo $dollar_number; ?> </td>
                            <td> 100 </td>
                            <td> <?php echo number_format($price_request, 2); ?> </td>
                        </tr>
                    </tbody>
                </table>
                <p class="quntity_total"> مجموع الكميات : <?php echo $dollar_number; ?> </p>
                <?php $old_total = $dinar_value * $price_request; ?>
                <p class="quntity_total"> وذلك مقابل : <span id="total_value"><?php echo number_format($old_total, 2); ?></span></p>
                <hr>
                <p style="font-size: 18px;"> مجموع الفاتورة : <?php echo number_format($price_request, 2); ?> </p> <!-- هضيف لو فية خصم  -->
                <div class="cash_add">
                    <div>
                        <p> المبلغ المستلم  <input type="number" style="border: none;"> </p>
                    </div>
                    <div class="discount">
                        <p> الخصم / الاضافة <input type="number" id="discount" style="border: none;"> </p>
                    </div>
                </div>
                <div class="cash_add" style="margin-top: 0;">
                    <div>
                        <p> المبلغ المتبقي  <input type="number" style="border: none;"> </p>
                    </div>
                    
                </div>
                <div class="price_need">
                    <p> المبلغ المستحق </p>
                    <h4> <?php echo number_format($price_request, 2); ?> دولار </h4>
                    <p class="phone_number"> رقم الاتصال : <?php echo $phone; ?> </p>
                    <p class="address"> العنوان : <?php echo $city; ?> </p>
                    <p class="copy"> يرجي ذكر امانة فقط </p>
                </div>
            </div>
            <div class="footer_print">
                <p> طبعت الفاتورة في : <?php echo date("Y / m / d"); ?> الوقت : <?php echo date('H:i:s', time()); ?> </p>
                <p> اسم المستخدم : [ <input style="border: none;" type="text"> ] </p>
            </div>
        </div>
        <button id="print_Button" onclick="window.print(); return false;" class="btn btn-primary"> طباعة الطلب <i class="fa fa-print"></i> </button>
    </div>

</div>

<style>
    .print {
        background-color: #fff;
    }

    .print .data {
        background-color: #fff;
        margin: auto;
        padding: 25px;
    }

    .print .data img {
        text-align: center;
        max-width: 200px;
        margin: auto;
        display: block;
    }

    .print .info .head {
        text-align: center;
    }

    .print .info .head h2 {
        margin-bottom: 40px;
        margin-top: 35px;
    }

    hr {
        border-top: 2px solid rgb(154 154 154);
    }

    .print .info .head p {
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .print .info .invoice_info {
        margin-top: 35px;
    }

    .print .info .invoice_info p {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
    }

    .print .info .invoice_info h4 {
        text-align: center;
        font-weight: bold;
    }

    .print .info .invoice_info ul {
        margin-top: 20px;
        margin-bottom: 35px;
    }

    .print .info .invoice_info ul li {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .print .info .invoice_info ul li strong {
        font-weight: bold;
    }

    .print .info .customer_info {
        margin-top: 35px;
    }

    .print .info .customer_info .customer_name {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 30px;
    }

    .print .info .customer_info .quntity_total {
        font-size: 18px;
        margin-bottom: 35px;
    }

    .print .info .customer_info .cash_add {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 25px;
        margin-bottom: 25px;
    }

    .print .info .customer_info .cash_add .discount {
        margin-right: 60px;
    }

    .print .info .price_need {}

    .print .info .price_need p:first-of-type {
        text-align: center;
        font-size: 18px;
    }

    .print .info .price_need h4 {
        text-align: center;
        border: 1px solid #000;
        padding: 12px;
        width: 80%;
        margin: auto;
        margin-bottom: 25px;
        margin-top: 25px;
    }

    .print .info .price_need p {
        font-size: 18px;
    }

    .print .info .price_need .address {
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
        margin-top: 30px;
    }

    .print .info .price_need .copy {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 60px;
    }

    .print .info .footer_print {
        text-align: center;
    }

    .table {
        text-align: center;
    }

    .table thead th {
        border-bottom: 2px solid #020202;
    }

    .table-bordered td,
    .table-bordered th {
        border: 2px solid #020202;
    }

    @media print {

        .footer,
        .bottom_footer,
        .main_navbar,
        .instagrame_footer {
            display: none !important;
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#discount').on('input', function() {
            var discount = $(this).val();
            console.log(discount);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // استجابة لحدث الكتابة داخل الحقل
        $('#discount').on('input', function() {
            // احتساب القيمة الجديدة بمضاعفة السعر بالكمية الجديدة
            var new_value = -parseFloat($(this).val()) + <?php echo $old_total; ?>;
            // تحديث نص العنصر <p> بالقيمة الجديدة
            $('#total_value').text(new_value.toFixed(2));
        });
    });
</script>