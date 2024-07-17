<?php
//include 'location_currancy.php';
include 'admin/connect.php';
$tem = "include/";
$css = "themes/css/";
$js = "themes/js/";
$uploads = "uploads/";
include $tem . "header.php";
include $tem . "navbar2.php";
date_default_timezone_set('Asia/Baghdad');
function sanitizeInput($input)
{
    // Use appropriate sanitization or validation techniques based on your requirements
    $sanitizedInput = htmlspecialchars(trim($input));
    return $sanitizedInput;
}
