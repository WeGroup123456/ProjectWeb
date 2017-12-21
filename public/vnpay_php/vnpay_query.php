<div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Querydr</h3></div>
<div style="width: 100% ;border-bottom: 2px solid black;padding-bottom: 20px" >
    <form action="http://117.6.131.222/rando/vnpay_php/index.php?url=vnpay_query" id="frmCreateOrder" method="post">        
        <div class="form-group">
            <label >Terminal</label>
            <input class="form-control" data-val="true"  name="terminal" type="text" value="" />
        </div>
        <div class="form-group">
            <label >OrderID</label>
            <input class="form-control" data-val="true"  name="orderid" type="text" value="" />
        </div>
        <div class="form-group">
            <label >Version</label>
            <input class="form-control" data-val="true"  name="version" type="text" value="2.0.0" />
        </div>
        <input type="submit"  class="btn btn-default" value="Querydr" />
    </form>
</div>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("./log4php/Logger.php");
require_once("config.php");
// Tell log4php to use our configuration file.
Logger::configure('log4php.xml');
// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('VnpayGatewaylogger');
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$vnp_Url = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$terminal=$_POST["terminal"];
$orderid=sql_escape(($_POST["orderid"]));
$version=$_POST["version"];
$hashSecret = $vnpay_hash_secret;
$result = $conn->query("SELECT * FROM `orders` WHERE OrderId='".$orderid."'") or die("Lỗi không có mã tin này");
$row = $result->fetch_object();
$originalDate = $row->vpc_PayDate;
$ipaddr=$_SERVER['REMOTE_ADDR'];
$newDate = date('YmdHis', strtotime($originalDate));
$inputData = array(
    "vnp_Version" => $version,
    "vnp_Command" => "querydr",
    "vnp_TmnCode" => $terminal,
    "vnp_Merchant" => "VNPAY",
    "vnp_TxnRef" => $orderid,
    "vnp_OrderInfo" => $row->OrderDescription,
    "vnp_TransDate" => $newDate,
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_IpAddr" => $ipaddr
);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($hashSecret)) {
    $vnpSecureHash = md5($hashSecret . $hashdata);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
mysqli_close($conn);
$ch = curl_init($vnp_Url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
