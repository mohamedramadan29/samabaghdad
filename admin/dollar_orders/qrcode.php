<?php
include "phpqrcode/qrlib.php";

// الحصول على معرف الطلب
$order_id = $_GET['order_id'] ?? null;

if (!$order_id) {
    die('Order ID is missing.');
}

// الاتصال بقاعدة البيانات
include 'admin/connect.php';

// استرداد بيانات الطلب
$stmt = $connect->prepare("SELECT * FROM dollar WHERE id = ?");
$stmt->execute(array($order_id));
$order_data = $stmt->fetch();

if (!$order_data) {
    die('Order not found.');
}

// جمع المعلومات لإنشاء الباركود
$name = $order_data['dollar_name'];
$date = $order_data['created_at'];
$travel_date = $order_data['travel_date'];
$order_number = $order_data['order_number'];
$serv_name = 'شراء الدولار لأغراض السفر';
$travel_to = $order_data['travel_to'];
$branch = $order_data['where_receieve_dollar'];
$amount = $order_data['dollar_amount'];
$order_step = $order_data['step_number'];
$info = ' تم تاكيد الطلب الخاص بك  ';
$qcodedata = "الاسم: $name\nالتاريخ: $date\nرقم الحجز: $order_number\nرقم الدور: $order_step\nالخدمة: $serv_name\nتاريخ السفر: $travel_date\nبلد الوجهة: $travel_to\nالفرع: $branch\nالمبلغ: $amount\n :: $info\n";

// مسار حفظ الصورة لرمز الاستجابة السريعة
$newPath = 'uploads/qr_codes/';

// اسم الملف لرمز الاستجابة السريعة
$fileName = uniqid() . $name . ".png";

// الجمع بين المسار واسم الملف للحصول على المسار الكامل للصورة
$fullFilePath = $newPath . $fileName;

// تعيين إعدادات QR
QRcode::png($qcodedata, $fullFilePath, QR_ECLEVEL_H, 4);

// عرض الصورة
echo '<img src="' . $fullFilePath . '" />';

?>
<a href="<?php echo $fullFilePath; ?>" class="btn btn-primary" download> تحميل الصورة <i class="fa fa-download"></i>  </a> 