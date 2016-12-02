<?php
require 'vendor/autoload.php';

$data = $_POST['data'];
$total_price = 0;
$body = "<table width='100%'>
        <thead>
            <tr>
                <th width='20%'>Amount</th>
                <th>Library Materials & Services</th>
                <th width='20%'>Value</th>
            </tr>
        </thead><tbody>";
foreach ($data as $d) {
    $total_price += (int)$d['amount'] * (int)$d['price'];
    $body .= "<tr><td>{$d['amount']}</td><td>{$d['name']}</td>{$d['price']}</tr>";
}

$body .= "</tbody><tfoot><tr><td></td><td></td><td>$total_price</td></tr></tfoot>";

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'example.hostname.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'example@email.com';                 // SMTP username
$mail->Password = '******';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('example@email.com');
$mail->addAddress('example@email.com');     // Add a recipient
$mail->addReplyTo('example@email.com');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Library Value Calculater Result';
$mail->Body    = $body;

if(!$mail->send()) {
    echo json_encode(array("status" => false, "message" => $mail->ErrorInfo));
} else {
    echo json_encode(array("status" => true));
}