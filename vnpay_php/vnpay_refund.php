<div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Refund</h3></div>
<div style="width: 100% ;border-bottom: 2px solid black;padding-bottom: 20px" >
    <form action="/vnpay_php_db/index.php?url=vnpay_refund" id="frmCreateOrder" method="post">        
        <div class="form-group">
            <label >Terminal</label>
            <input class="form-control" data-val="true"  name="terminal" type="text" value="" />
        </div>
        <div class="form-group">
            <label >OrderID</label>
            <input class="form-control" data-val="true"  name="orderid" type="text" value="" />
        </div>
        <div class="form-group">
            <label>Kiểu hoàn tiền </label>
            <select name="trantype" id="trantype" class="form-control">
                <option value="02">Hoàn tiền toàn phần</option>
                <option value="03">Hoàn tiền 1 phần</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Số tiền</label>
            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="10000" />
        </div>
        <div class="form-group">
            <label >Version</label>
            <input class="form-control" data-val="true"  name="version" type="text" value="2.0.0" />
        </div>
        <div class="form-group">
            <label >Mail người khởi tạo GD hoàn tiền</label>
            <input class="form-control" data-val="true"  name="mail" type="text" value="" />
        </div>
        <input type="submit"  class="btn btn-default" value="Refund" />
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
$terminal = ($_POST["terminal"]);
$orderid =  sql_escape(($_POST["orderid"]));
$version = ($_POST["version"]);
$amount = ($_POST["amount"]);
$mail = ($_POST["mail"]);
$trantype = ($_POST["trantype"]);
$hashSecret = $vnpay_hash_secret;
$result = $conn->query("SELECT * FROM `orders` WHERE OrderId='".$orderid."'") or die("Lỗi không có mã tin này");
$row = $result->fetch_object();
$amountrefund = $amount;
$amountpayment = $row->Amount;
if ($amountrefund <= $amountpayment) {
    $originalDate = $row->vpc_PayDate;
    $ipaddr = $_SERVER['REMOTE_ADDR'];
    $newDate = date('YmdHis', strtotime($originalDate));
    $inputData = array(
        "vnp_Version" => $version,
        "vnp_TranType" => $trantype,
        "vnp_Command" => "refund",
        "vnp_Merchant" => "VNPAY",
        "vnp_CreateBy" => $mail,
        "vnp_TmnCode" => $terminal,
        "vnp_TxnRef" => $orderid,
        "vnp_Amount" =>$amountrefund,
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
}
 else {
echo "<h2 style=\"color: red\">Số tiền hoàn phải nhỏ hơn hoặc bằng số tiền GD đã thanh toán</h2>";    
}
?>
<div style="clear: both"><a href="index.php">Về danh sách</a></div>