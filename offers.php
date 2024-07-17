<?php
ob_start();
session_start();
include 'init.php';

$stmt = $connect->prepare("SELECT * FROM offers ORDER BY id DESC LIMIT 1");
$stmt->execute();
$offers_data = $stmt->fetch();
$offer_image = $offers_data['image'];
?>

<div class="offers" style="background-image: url(admin/offers/uploads/<?php echo $offer_image; ?>);">
<div class="container">
    <div class="data">
        <img src="" alt="">
    </div>
</div>
</div>
<?php
include $tem . 'footer.php';
ob_end_flush();
?>
<style>
    .offers {
        background-size: cover;
        background-position: center;
        height: 100vh;
    }
</style>