<?php
ob_start();
session_start();
include 'admin/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  echo "Gooooood";
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    try {
        $formerror = [];
        $dollar_amount = $_SESSION['dollar_amount'];
        //echo $dollar_amount;
        // echo "</br>";
        $allah = $_SESSION['allah'];
        //echo $allah;
        $port_type = $_SESSION['port_type'];
        $where_receieve_dollar = $_SESSION['where_receieve_dollar'];
        $dollar_phone     = $_SESSION['dollar_phone'];
        $dollar_name = $_SESSION['dollar_name'];
        $travel_date = $_SESSION['travel_date'];
        $travel_to = $_SESSION['travel_to'];
        $dollar_how_pay = $_SESSION['dollar_how_pay'];
        date_default_timezone_set('Asia/Baghdad');
        $date = date('Y-m-d H:i');
        ///////////////// Upload Id Number Images 

        ///////////Insert Passport Image /////////
        if (!empty($_FILES['passport_image']['name'])) {

            $passport_image_name = $_FILES['passport_image']['name'];
            $passport_image_name = str_replace(' ', '', $passport_image_name);
            $passport_image_temp = $_FILES['passport_image']['tmp_name'];
            $passport_image_type = $_FILES['passport_image']['type'];
            $passport_image_size = $_FILES['passport_image']['size'];
            $passport_image_uploaded = time() . '_' . $passport_image_name;
            move_uploaded_file($passport_image_temp, 'admin/dollar_orders/uploads/' . $passport_image_uploaded);
        } else {
            $formerror[] = ' من فضلك ادخل صورة جواز السفر ';
        }
        ///////////Insert Ticket Image  /////////
        if (!empty($_FILES['ticket_image']['name'])) {

            $ticket_image_name = $_FILES['ticket_image']['name'];
            $ticket_image_name = str_replace(' ', '', $ticket_image_name);
            $ticket_image_temp = $_FILES['ticket_image']['tmp_name'];
            $ticket_image_type = $_FILES['ticket_image']['type'];
            $ticket_image_size = $_FILES['ticket_image']['size'];
            $ticket_image_uploaded = time() . '_' . $ticket_image_name;
            move_uploaded_file($ticket_image_temp, 'admin/dollar_orders/uploads/' . $ticket_image_uploaded);
        } else {
            $formerror[] = ' من فضلك ادخل صورة تذكرة السفر  ';
        }
        // get the order number 
        $stmt = $connect->prepare("SELECT * FROM dollar ORDER BY id DESC");
        $stmt->execute();
        $last_order = $stmt->fetch();
        $last_order_number = $last_order['order_number'];
        //$new_order_number = $last_order_number + 1;
        $new_order_number = rand(1000,9000 );
        $last_step_number = $last_order['step_number'];
        if ($last_step_number >= 100) {
            $new_step_number = 10;
        } else {
            $new_step_number = $last_step_number + 1;
        }

        $_SESSION['order_number'] = $new_order_number;
        $_SESSION['step_number'] = $new_step_number;
        if (empty($formerror)) {
            $stmt = $connect->prepare("INSERT INTO dollar (order_number,step_number,dollar_amount,allah,port_type,where_receieve_dollar,
                        dollar_phone,dollar_name,travel_date,travel_to,dollar_how_pay,passport_image,ticket_image,id_image_first,person_image,created_at)
                        VALUES(:zorder_number,:zstep_number,:zdollar_amount,:zallah,:zport_type,:zwhere_receieve_dollar,:zdollar_phone,:zdollar_name,
                        :ztravel_date,:ztravel_to,:zdollar_how_pay,:zpassport_image,:zticket_image,:zid_image_first,:zperson_image,:zcreated_at)
                        ");
            $stmt->execute(array(
                "zorder_number" => $new_order_number,
                "zstep_number" => $new_step_number,
                "zdollar_amount" => $dollar_amount,
                "zallah" => $allah,
                "zport_type" => $port_type,
                "zwhere_receieve_dollar" => $where_receieve_dollar,
                "zdollar_phone" => $dollar_phone,
                "zdollar_name" => $dollar_name,
                "ztravel_date" => $travel_date,
                "ztravel_to" => $travel_to,
                "zdollar_how_pay" => $dollar_how_pay,
                "zpassport_image" => $passport_image_uploaded,
                "zticket_image" => $ticket_image_uploaded,
                "zid_image_first" => null,
                "zperson_image" => null,
                "zcreated_at" => $date
            ));
            if ($stmt) {
                echo json_encode(['success' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => implode('<br>', $formerror)]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
ob_end_flush();
