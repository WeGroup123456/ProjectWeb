<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
/**
 * Description of vnpay_ajax
 *
 * @author thangnh
 */
// echo date('YmdHis');
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("./log4php/Logger.php");
require_once("./config.php");
// Tell log4php to use our configuration file.
Logger::configure('log4php.xml');
// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('VnpayGatewaylogger');
// New Connection
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    $log->info("Connection failed: " . $conn->connect_error);
}
$log->info("Connected successfully");
//Khởi tạo đơn hàng
$date = date('Y-m-d H:i:s');
$log->info($date . "BEGIN INIT");
$vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/ProjectWebFront/ProjectWeb/public/vnpay_php/vnpay_return.php";



//$vnp_TxnRef = rand(1, 1500);
$info=convert_vi_to_en($_POST['orderDesc']);
$vnp_OrderInfo = sql_escape(($info));
$vnp_OrderType =sql_escape($_POST['ordertype']);
$vnp_Amount =($_POST['amount']) * 100;
$amount=sql_escape($_POST['amount']);
//param id user
$user_id = $_POST['userid'];
$vnp_Locale = sql_escape($_POST['language']);

$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
$vnp_UserAgent = $_SERVER['HTTP_USER_AGENT'];
$newtimestamp = strtotime($date . '+ 15 minute');

//Insert đơn hàng vào DB
$sql = "INSERT INTO `orders` ( Amount,UserId, OrderDescription, IpAddr, UserAgent,CreatedDate,Status) "
        . "VALUES ( $amount, $user_id, '" . $vnp_OrderInfo . "','" . $vnp_IpAddr . "','" . $vnp_UserAgent . "','" . $date . "',0)";
if ($conn->query($sql) === TRUE) {
    $log->info("New record created successfully");
    $vnp_TxnRef = $conn->insert_id;
} else {
    $log->info("Error: " . $sql . "<br>" . $conn->error);
}

$inputData = array(
    "vnp_TmnCode" => $vnpay_tmn_code, //Tham so nay lay tu VNPAY
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_Version" => "2.0.0",
);
$out = $inputData;
if (isset($_POST['bankcode']) && $_POST['bankcode'] != NULL) {
    $out = array_merge($inputData, array("vnp_BankCode" => $_POST['bankcode']));
}
ksort($out);
$query = "";
$i = 0;
$hashdata = "";
foreach ($out as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnpay_hash_secret)) {
    $vnpSecureHash = md5($vnpay_hash_secret . $hashdata);
    $vnp_Url .= 'vnp_SecureHashType=MD5&vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
mysqli_close($conn);
$log->info($date . "     Connected close");
$log->info($date . "     END INIT");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
}
