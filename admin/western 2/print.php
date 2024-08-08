<?php
$wester_id = $_GET['request_id'];
$stmt = $connect->prepare("SELECT * FROM new_western_accounts WHERE id = ?");
$stmt->execute(array($wester_id));
$data = $stmt->fetch();
$send_name = $data['send_name'];
$send_phone = $data['send_phone'];
$send_address = $data['send_address'];
$send_id_type = $data['send_id_type'];
$send_id_number = $data['send_id_number'];
$send_purpose = $data['send_purpose'];
$recieve_name = $data['recieve_name'];
$recieve_country = $data['recieve_country'];
$mtcn = $data['mtcn'];
$date = $data['date'];
$time = $data['time'];
$amount_send = $data['amount_send'];
$fee = $data['fee'];
$total = $data['total'];
$exchange_rate = $data['exchange_rate'];
$payout_amount = $data['payout_amount'];
$agent_details = $data['agent_details'];
?>

<div class="print">
    <div class="data">
        <div class="first_section">
            <img class="western_logo" src="uploads/up_logo.png">
            <h2> To Send </h2>
        </div>
        <div class="second_section" style="border-bottom: 2px solid #000;">
            <div class="row">
                <div class="col-4">
                    <div class="info" style="margin-right: 5px;">
                        <p style="display: flex; justify-content:space-between" class="mtcn"> <span class="span"> MTCN : </span> <span style="font-family: 'arial';"> <?php echo $mtcn; ?> </span> </p>
                        <p style="display: flex; justify-content:space-between" class="date_time"> <span class="span"> Data & Time : </span> <span style="font-family: 'arial';"> <?php echo $date ?> <?php echo $time; ?> </span> </p>
                        <p style="display: flex; flex-wrap:wrap;justify-content:space-between" class="agent_details"> <span class="span"> Agent details : </span> <?php echo $agent_details; ?> </p>
                        <p style="display: flex; justify-content:space-between;margin-top:45px" class="amount_send"> <span class="span"> Amount Send : </span> <?php echo $amount_send ?> </p>
                        <p style="display: flex;justify-content:space-between;margin-bottom:3px" class="transfer_fee"> <span class="span"> Transfer Fee : </span> <?php echo $fee ?> </p>
                        <p style="display: flex;justify-content:space-between;margin-bottom:3px" class="message_charge"> <span class="span"> Message Charge : </span> 0.00 </p>
                        <p class="delivery_charge" style="margin-bottom:3px"> <span class="span"> Delivery Charge : </span> </p>
                        <p class="discount" style="margin-bottom:3px"> <span class="span"> Discount : </span> </p>
                        <p style="display: flex;justify-content:space-between;margin-bottom:3px" class="total"> <span class="span"> TOTAL : </span> <span style="font-family: 'arial';"> <?php echo $total ?> </span> <span> USDollar </span> </p>
                        <p style="display: flex;justify-content:space-between;margin-bottom:3px" class="exchange_rate"> <span class="span"> Exchange Rate : </span> <span style="font-family: 'arial';"> <?php echo $exchange_rate; ?> </span> </p>
                        <p style="display: flex;justify-content:space-between;margin-bottom:3px" class="payout_amount"> <span class="span"> Payout Amount : </span> <span style="font-family: 'arial';"> <?php echo $payout_amount; ?> </span> <span> USDollar </span> </p>
                    </div>
                </div>
                <div class="col-4" style="border-right:2px solid #000">
                    <div class="info">
                        <p style="margin-bottom: 57px;" class="recieve_name"> <span class="span"> Receiver : </span> <?php echo $recieve_name; ?> </p>
                        <p style="margin-bottom: 5px;" class="recieve_city"> <span class="span"> City : </span> </p>
                        <p style="margin-bottom: 5px;" class="recieve_country"> <span class="span"> Country : </span> <?php echo $recieve_country; ?> </p>
                        <p style="margin-bottom: 70px;" class="optional_serv"> <span class="span"> Optional Services : </span> MONEY IS MINUTES </p>
                        <p style="margin-bottom: 70px;" class="message"> <span class="span"> Message : </span> </p>
                        <p class="relation"> <span class="span"> Receiver Mobile Number : </span> </p>
                        <p class="relation"> <span class="span"> (if sending to Mobile) </span> </p>
                    </div>
                </div>
                <div class="col-4" style="border-right:2px solid #000">
                    <div class="info one_info" dir="ltr">
                        <p style="margin-bottom: 20px;" class="send_name"> <span class="span"> Sender : </span> <?php echo $send_name; ?> </p>
                        <p style="margin-bottom: 30px;" class="send_phone" dir="ltr"> <span class="span"> Adress/Telephone : </span> <span style="font-family: 'arial';"> <?php echo  $send_phone; ?> </span> <br> <?php echo $send_address; ?> </p>
                        <p class="id_type relation"> <span class="span"> ID Type : </span> <?php echo $send_id_type; ?> </p>
                        <p class="id_number relation"> <span class="span"> ID Number : </span> <span style="font-family: 'arial';"> <?php echo $send_id_number; ?> </span> </p>
                        <p class="purpose relation"> <span class="span"> Purpose of Transaction : </span> <?php echo $send_purpose; ?> </p>
                        <p class="relation"> <span class="span"> Relationship : </span> </p>
                        <p class="relation"> <span class="span"> Occupation : </span> </p>
                        <p class="relation"> <span class="span"> Test Question : </span> </p>
                        <p class="relation"> <span class="span"> Answer : </span> </p>
                        <p class="relation"> <span class="span"> Sender Mobile Number : </span> </p>
                        <p class="relation"> <span class="span"> (if sending to a Mobile) </span> </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_three" style="text-align: left;">
            <p> If you choose to provide details of your landline/mobile phone and/or your e-mail in the optional entries above you also expressly consent to receipt of such commercial communications in the indicated medium(telephone/SMS/MMS/e-mail), to being notified of transfer collection by SMS and agree that any charges imposed by the provider of such services are your sole responsibility
            </p>
        </div>
        <div class="section_eight">
            <div class="sec1">
                <h5> <i class="fa fa-envelope"></i> SPECIAL MESSAGE FOR </h5>
                <p> Thank you for using Western Union. Visit us at anytime on westernunion.com </p>
            </div>
            <div class="sec2">
                <h4 style="margin-top: 10px;"> Enrolling to the Golde Card Program </h4>
                <h4> Gold Card Number </h4>
                <h4> Points Earned </h4>
                <h4> Total Points </h4>
            </div>
        </div>
        <div class="section_three section_four">
            <p>
                IMPORTANT NOTICE: THE TERMS AND CONDITIONS ON WHICH THE SERVICE IS PROVIDED ARE SET OUT BELOW. YOU ARE ADVISED TO READ THESE TERMS AND CONDITIONS, ESPECIALLY THOSE RESTRICTING LIABILITY AND DATA PROTECTION, BEFORE SIGNING THIS FORM. IN ADDITION TO THE TRANSFER FEE, WESTERN UNION AND ITS AGENTS ALSO MAKE MONEY FROM THE EXCHANGE OF CURRENCIES. PLEASE SEE FURTHER IMPORTANT INFORMATION REGARDING CURRENCY EXCHANGE AND LEGAL RESTRICTIONS THAT MAY DELAY THE TRANSACTION SET FORTH BELOW. PROTECT YOURSELF FROM CONSUMER FRAUD. BE CAREFUL WHEN A STRANGER ASKS YOU TO SEND MONEY. DO NOT DIVULGE THE DETAILS OF THIS TRANSFER TO A THIRD PARTY .
            </p>
        </div>
        <div class="section_five" style="text-align: left;">
            <div class="text">
                <p>
                    By singning this from, I : 1 .Expressly consent to the transfer of my personal data entered above to WU. Affiliates located in countries such as the U.S. for the purpose of providing the money transfer service to
                    me and undertaking the additional data processing activities specified in the Data Protection section of the terms and conditions. I have the right to withdraw my consent at any time.
                </p>
                <p> 2 . Expressly consent to the carrying out of profiling activities and marketing communications . </p>
                <p style="padding-bottom: 4px;"> 3 . Confirm that the information I have provided is correct and that I have read and accepted the terms and
                    conditions of the service below.</p>
            </div>
            <div class="customer_sign">
                <h3> Customer signature: </h3>
                <img src="uploads/client.jpeg" alt="">
            </div>
            <div class="customer_sign">
                <h3> Agent signature: </h3>
            </div>
        </div>
        <div class="section_sex">
            <p> WESTERN UNION® MONEY TRANSFERSM SERVICE IS PROVIDED ON THE FOLLOWING TERMS AND CONDITIONS </p>
        </div>
        <div class="section_seven">
            <div class="row">
                <div class="col-6">
                    <div class="info">
                        <p>
                            CustomersWestern Union Money Transfer SM transactions can be sent and picked up at most Western Union@ Agent locations worldwide may call the number listed above for the address and hours of nearby locations. Some locations are open hours Regular money transfers are usually available within minutes for pick up by the receiver, subject to the opening hours of the receiving Western Union Agent("Agent")location. The Next Day/ Day and account-based money transfer services are available upon request to limited countries. The money sent using the Next Day/ Day money transfer service will be available for collection after and hours respectively. Account-based transfers generally take business days, though transfers to mobile wallets are often available within minutes. Delays and other restrictions apply in certain countries. Call the number above for details
                            Money transfers will normally be paid in cash, but some Agents will pay by cheque or a combination of cash and cheque or may offer or the receiver may choose other ways to receive funds and some money transfers may be paid to accounts. All cash payments are subject to availability, receivers showing documentary evidence of their identity and providing all details about the money transfer required by Western Union, including sender's and receiver's names, country of origin, approximate sum and any other conditions or requirements applicable at the Agent location, for example the money transfer control number, which is mandatory for payout in some countries. The sender authorizes Western Union to honor the receiver's choice of method to receive funds even if it differs from the sender's. Cash money transfers shall be paid to the person that Agents deem entitled to receive the transaction after verification of identity often through examination of identification documents. Such payment can be made even when the form filled out by the receiver contains errors. Neither Western Union nor its Agents carry out a comparison of the "To Send Money" form against the "To Receive Money" form to verify the address given for the receiver. In some destinations the receiver may be required to provide identification, a test question answer or both to receive funds i à cash. Test questions are not an additional security feature and cannot be used to time or delay the payment of
                            a transaction and are prohibited in certain countries. Applicable law prohibits money transmitters from doing business with certain individuals and countries.


                        </p>


                    </div>
                </div>
                <div class="col-6">
                    <div class="info">
                        <p>
                            LIABILITY WESTERN UNION DOES NOT GUARANTEE THE DELIVERY OR SUITABILITY OF ANY GOODS OR SERVICES PAID FOR BY MEANS OF A WESTERN UNION MONEY TRANSFER. THE SENDER'S TRANSACTION DATA IS CONFIDENTIAL TO HIM AND SHOULD NOT BE SHARED WITH ANY OTHER PERSON OTHER THAN HIS RECEIVER. THE SENDER IS CAUTIONED AGAINST SENDING MONEY TO ANY PERSON HE DOES NOT KNOW. IN NO EVENT SHALL WESTERN UNION OR ANY OF ITS AGENTS BE LIABLE IF THE SENDER COMMUNICATES TRANSACTIONAL DATA TO ANY PERSON OTHER THAN HIS RECEIVER. IN NO EVENT SHALL WESTERN UNION OR ANY OF ITS AGENTS BE LIABLE FOR DAMAGES FOR DELAY, NONPAYMENT OR UNDERPAYMENT OF THIS MONEY TRANSFER, OR NON-DELIVERY OF ANY SUPPLEMENTAL MESSAGE, WHETHER CAUSED BY NEGLIGENCE ON THE PART OF THEIR EMPLOYEES OR AGENTS OR OTHERWISE, BEYOND THE SUM EQUIVALENT TO $ U.S. DOLLARS (IN ADDITION TO REFUNDING THE PRINCIPAL AMOUNT OF THE MONEY TRANSFER AND THE TRANSFER FEE). IN NO EVENT WILL WESTERN UNION OR ITS AGENTS BE LIABLE FOR ANY INDIRECT, SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGES. THE FOREGOING DISCLAIMER SHALL NOT LIMIT WESTERN UNION'S OR AGENT'S LIABILITY FOR DAMAGES RESULTING FROM WESTERN UNION'S OR AGENT'S GROSS NEGLIGENCE OR INTENTIONAL MISCONDUCT IN THOSE .JURISDICTIONS WHERE SUCH A LIMITATION OF LIABILITY IS VOID
                            When an Agent accepts a cheque draft, credit or debit card or other non-cash form of payment, neither Western Union. nor the Agent assumes any obligation to process or pay the money transfer if the form of payment is uncollectible, nor do they assume any liability for damages resulting from nonpayment of the money transfer by reason of such uncollectibility. Western Union reserves the right to change these terms and conditions or the offered service without notice. Western Union and its Agents may .refuse to provide service to any person
                            DATA PROTECTION - Your personal information is processed under the applicable laws.


                        </p>
                    </div>
                </div>
            </div>
        </div>

        <button style="margin:auto;display:block" id="print_Button" onclick="window.print(); return false;" class="btn btn-primary"> <i class="fa fa-print"></i> </button>
    </div>

</div>

<style>
    @font-face {
        font-family: 'my_custom1';
        src: url('themes/fonts/STPTKI-Arial-BoldMT.ttf');
    }

    @font-face {
        font-family: 'my_custom2';
        src: url('themes/fonts/ELONWK-Arial-BoldMT.ttf');
    }

    .data {
        background-color: #fff;
        border: 2px solid #000;
        font-family: 'my_custom1';
    }

    .data .span {
        font-family: 'my_custom2', 'Arial';
        font-size: 18px;
    }

    .data .section_eight {
        border-bottom: 2px solid #000;
        text-align: left;
        display: flex;
        justify-content: space-between;
        direction: ltr;
    }

    .data .section_eight .sec1 {
        border-right: 2px solid #000;
        width: 60%;
        padding-left: 10px;
    }

    .data .section_eight .sec1 h5 {}

    .data .section_eight .sec1 h5 i {}

    .data .section_eight .sec1 p {
        margin-top: 77px;
        font-size: 14px;
        font-weight: 600;
        padding: 0;
        margin-bottom: 0;
    }

    .data .section_eight .sec2 {
        width: 40%;
    }

    .data .section_eight .sec2 h4 {
        margin-left: 12px;
        font-size: 18px;
        font-weight: 600;
    }



    .data .first_section {
        border-bottom: 2px solid #000;
        padding: 5px;
        position: relative;
    }

    .data .first_section img {
        width: 180px;
        margin-left: 3px;
        position: absolute;
        left: 0;
        top: 13%;
    }

    .data .first_section h2 {
        text-align: center;
        margin: 0;
        padding: 0;
        font-weight: 100;
        font-size: 35px;
        font-weight: bold;
    }

    .data .second_section {}

    .data .second_section .info {
        margin-left: 10px;
    }

    .data .second_section .one_info {
        margin-left: 15px;
    }

    .data .second_section p {
        direction: ltr;
        text-align: left;
        font-weight: bold;
        color: #000;
        font-size: 17px;
        line-height: 1.5;
    }

    .data .second_section .relation {
        margin-bottom: 4px;
    }

    .data .section_three {
        border-bottom: 2px solid #000;
        padding-left: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-right: 10px;
        color: #000;
    }

    .data .section_three p {
        margin: 0;
        padding: 0;
        text-align: justify;
        direction: ltr;
        font-size: 14px;
        color: #000;
        font-weight: 600;
        line-height: 1.3;

    }

    .data .section_four p {
        text-transform: uppercase;
        color: #000;
        font-size: 14px;
        line-height: 1.3;
    }

    .data .section_five {
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        flex-direction: row-reverse;
        color: #000;
        border-bottom: 2px solid #000;
        margin: 0;
        padding-bottom: 0px;
    }

    .data .section_five .text {
        width: 55%;
        margin-top: 5px;
        color: #000;
    }

    .data .section_five .text p {
        font-size: 14px;
        color: #000;
        font-weight: 600;
        text-align: left;
        direction: ltr;
        line-height: 1.2;
        margin: 0;
    }

    .data .section_five .customer_sign {
        border-left: 2px solid #000;
        width: 28%;
        direction: rtl;
        color: #000;
    }

    .data .section_five .customer_sign img {
        width: 52%;
        transform: rotate(-19deg);
        margin-top: 21px;
        margin-left: 52px;
    }

    .data .section_five .customer_sign h3 {
        text-align: left;
        direction: ltr;
        margin-left: 10px;
        font-weight: bold;
        font-size: 22px;
        margin-top: 5px;
        color: #000;
    }

    .data .section_sex {
        margin: 10px;
        margin-bottom: 0;
    }

    .data .section_sex p {
        text-align: center;
        font-size: 20px;
        color: #000;
        font-weight: bold;
        margin-bottom: 0;
    }

    .data .section_seven {
        direction: ltr;
        text-align: left;
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .data .section_seven p {
        text-align: justify;
        color: #000;
        font-size: 11px;
        font-weight: 700;
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
            /* padding: 10px !important; */
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
            margin-bottom: 0;
        }
    }
</style>