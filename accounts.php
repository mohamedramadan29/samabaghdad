<?php
ob_start();
session_start();
$page_title = 'حسابات سما بغداد';
include 'init.php';
?>

<div id="page-content">

    <div class="accounts">
        <div class="container">
            <div class="data">
                <h4> حسابات المنصة </h4>
                <table class="table table-bordered">
                <tbody>
                <?php 
                
                $stmt = $connect->prepare("SELECT * FROM western_payment_methods");
                $stmt->execute();
                $allpayments = $stmt->fetchAll();
                foreach ($allpayments as $payment){
                    ?>
                    <tr>
                    <th>  <?php echo $payment['title'] ?> </th>
                    <td> <?php echo html_entity_decode($payment['description']); ?> </td>
                </tr>
                <?php 
                }
                
                ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include $tem . 'footer.php';
ob_end_flush();
?>