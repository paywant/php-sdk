<?php

if (!$_POST) {
    die('paywant.com');
}

$apiKey = '0000-PAY-WANT-0000000-0000'; // api key
$apiSecret = '000000000000'; // api secret key

$transactionID = $_POST['transactionID'];
$extraData = $_POST['extraData'];
$userID = $_POST['userID'];
$userAccountName = $_POST['userAccountName'];
$status = $_POST['status'];
$paymentChannel = $_POST['paymentChannel'];
$paymentTotal = $_POST['paymentTotal'];
$netProfit = $_POST['netProfit'];
$hash = $_POST['hash']; // don't touch. (not need xss-filter, anti sql injection filter etc.)

$hashCheck = base64_encode(hash_hmac('sha256', "{$transactionID}|{$extraData}|{$userID}|{$userAccountName}|{$status}|{$paymentChannel}|{$paymentTotal}|{$netProfit}" . $apiKey, $apiSecret, true));
if ($hash != $hashCheck) {
    exit('hash failure');
}

// transactionID -> It is created by Paywant. You must log it for prevent duplicate notification. Because our IPN service is working async.

// extraData -> It is created by you. You can use it for your own purpose.

// userID -> It is created by Paywant. It is unique for each user.

// userAccountName -> It is created by Paywant. It is unique for each user.

// status === 100 -> Payment is completed., Other status codes are same as failed. We send only success notification. If you want failed notification, please contact us.

exit('OK'); // please return OK when charge is completed. If you return other string, we will send notification again.
