<?php
include "phpqrcode/qrlib.php";
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
/////////// qr code //////////

// دمج البيانات في سلسلة نصية واحدة
$data = "الأسم : $name\n";
$data .= "العنوان: $city\n";
$data .= "رقم الهاتف: $phone";
$newPath = 'uploads/qr_codes/'; // تأكد من وجود مسار مسبقًا أو قم بإنشائه

$fileName = uniqid() . time() . ".png";

// الجمع بين المسار واسم الملف للحصول على المسار الكامل للصورة
$fullFilePath = $newPath . $fileName;

// إنشاء رمز الاستجابة السريعة باستخدام البيانات والمسار
QRcode::png($data, $fullFilePath);
/////////// end qr code ///////

// get th company info 
$stmt = $connect->prepare("SELECT * FROM company_info");
$stmt->execute();
$com_data = $stmt->fetch();
$com_name = $com_data['name'];
$com_phone = $com_data['phone'];
$com_address = $com_data['address'];
$com_percent = $com_data['percent'];
?>
<div class="print print_document">
    <div class="data">
        <div class="first_section">
            <div class="first1">
                <button class="btn btn-default"> اصدار حوالة محلية </button>
            </div>
            <div class="first2">
                <img src="uploads/new.png" alt="">
            </div>
            <div class="first3">
                <p> رقم الحوالة : <span style="margin-right: 8px;"> <?php echo $request_number; ?> </span> </p>
                <p>  التاريــــــــــــــخ   : <span> <?php echo $request_order; ?> </span> </p>
            </div>
        </div>
        <div class="second_section">
            <div class="row">
                <div class="col-6">
                    <div class="first1">
                        <button class="btn btn-default"> معلومات المرسل </button>
                        <table class="table table-bordered">
                            <tbody>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> الأســـــــــــم </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"><?php echo $com_name; ?></th>
                                </tr>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> رقم الهاتف </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo $com_phone; ?> </th>
                                </tr>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> العنـــــــــوان </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo $com_address; ?> </th>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-default"> معلومات المستلم </button>
                        <table class="table table-bordered">
                            <tbody>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> الأســـــــــــم </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo $name; ?> </th>
                                </tr>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> رقم الهاتف </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"><?php echo $phone; ?></th>
                                </tr>
                                <tr style=" border: 2px solid #484646">
                                    <th style="border: 2px solid #484646 !important;padding:5px;width:35%"> العنـــــــــوان </th>
                                    <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo $city; ?> </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <div class="qr_section">
                        <div class="first2">
                            <button class="btn btn-default"> باركود التحقق من الحوالة : </button>
                        </div>
                        <div class="qrcode">
                            <img src="<?php echo $fullFilePath; ?>" alt="">
                        </div>
                    </div>
                    <div style="position: relative;top: 26px;">
                        <table class="table table-bordered">
                            <tr style=" border: 2px solid #484646">
                                <th style="border: 2px solid #484646 !important;padding:5px;width:35%;background-color:#c7c7c7!important;;"> سبب الحوالة : </th>
                                <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> تجارة </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row last_section">
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr style=" border: 2px solid #484646">
                            <th style="border: 2px solid #484646 !important;padding:5px;width:35%;background-color:#c7c7c7!important;;"> مبلغ الحوالة : </th>
                            <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo number_format($price_request, 2); ?> $ </th>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr style=" border: 2px solid #484646">
                            <th style="border: 2px solid #484646 !important;padding:5px;width:35%;background-color:#c7c7c7!important;"> العمولة : </th>
                            <?php $doc_percent =  $price_request *  ($com_percent / 100) ?>
                            <th style="border: 2px solid #484646 !important;padding:5px;text-align:center"> <?php echo number_format($doc_percent, 2) ?> $ </th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="signuture">
                <div>
                    <p> ص.ب ٣٤٥٢ </p>
                </div>
                <div>
                    <p> ختم مسؤول التدقيق والصرف  </p>
                </div>
                <div>
                    <p> ختم وتوقيع الحسابات   </p>
                </div>
                <div>
                    <p>  ختم وتوقيع المدير المفوض    </p>
                </div>
            </div>
        </div>

        <button id="print_Button" onclick="window.print(); return false;" class="btn btn-primary"> طباعة الطلب <i class="fa fa-print"></i> </button>
    </div>

</div>

<style>
    .print_document {}

    .print_document .data {
        max-width: 95% !important;
    }

    .print_document .first_section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .print_document .first_section .first1 {
        border-bottom: 2px solid #000;
        width: 40%;
    }

    .print_document .first_section .first1 button {
        color: #000;
        width: 250px;
        margin-bottom: 20px;
        border: 2px solid #000;
        border-radius: 0;
        font-weight: bold;
        background-color: #c7c7c7;
    }

    .print_document .first_section .first3 {
        width: 40%;
        border-bottom: 2px solid #000;
        margin-top: -18px;
    }

    .print_document .first_section .first3 p {
        font-weight: bold;
    }

    .print_document .first_section .first3 span {
        border-bottom: 1px solid #000;
        text-align: center;
        width: 170px;
        display: inline-block;
    }

    .print_document .data img {
        text-align: center;
        max-width: 170px !important;
        margin: auto;
        display: block;
        position: relative;
        top: 27px;
    }

    .print_document .second_section {}

    .print_document .second_section .first1 {}

    .print_document .second_section .first1 button {
        color: #000;
        width: 230px;
        margin-bottom: 15px;
        margin-top: 10px;
        border: 2px solid #000;
        border-radius: 0;
        font-weight: bold;
        background-color: #c7c7c7;
    }

    .print_document .second_section {}

    .qr_section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .qr_section button {
        color: #000;
        width: 240px;
        margin-bottom: 20px;
        border: 2px solid #000;
        border-radius: 0;
        font-size: 15px;
        font-weight: bold;
        background-color: #c7c7c7;
        position: relative;
        top: 20px;
        left: -50px;
    }

    .qr_section .qrcode img {
        position: relative;
        top: 10px;
    }

    .last_section {
        padding-bottom: 10px;
        border-bottom: 1px solid #000;
    }

    .signuture {
        padding-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
    }

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
        .content-wrapper {
            margin: 0;
            padding: 0;
            min-height: auto !important;
            padding: 0;
        }

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
            padding: 0;
            margin: 0;
        }

        #print_Button {
            display: none !important;
        }

        .print-link {
            display: none !important;
        }

        @page {
            margin: 0;
            padding: 0;
        }

        body {}

        .print {
            background-color: #fff;
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }
    }
</style>