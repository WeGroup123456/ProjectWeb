<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("./log4php/Logger.php");
require_once("./config.php");
// Tell log4php to use our configuration file.
Logger::configure('log4php.xml');
// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('VnpayGatewaylogger');
$log->info("BEGIN CALL IPN_URL");
// New Connection
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    $log->info("Connection failed: " . $conn->connect_error);
}
$log->info("Connected successfully");

$params = array();
$returnData = array();
$data = $_REQUEST;
foreach ($data as $key => $value) {
	if(substr($key,0,3)=="vnp")
	{
    $params[$key] = $value;
	}
}
$vnp_SecureHash = $params['vnp_SecureHash'];
unset($params['vnp_SecureHashType']);
unset($params['vnp_SecureHash']);
ksort($params);
$i = 0;
$hashData = "";
foreach ($params as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . $key . "=" . $value;
    } else {
        $hashData = $hashData . $key . "=" . $value;
        $i = 1;
    }
}
$vnpTranId =$_GET[ 'vnp_TransactionNo' ]; 
$secureHash = md5($vnpay_hash_secret . $hashData);
$Status = 0;
$Id = $_GET[ 'vnp_TxnRef' ];
$sql = "SELECT * FROM `orders` WHERE `OrderId`=" . sql_escape($Id);
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
try {
    //Check Orderid 
    if ($row["OrderId"] != NULL) {
        $log->info($row["OrderId"]);
        //Check chữ ký
        if ($secureHash == $vnp_SecureHash) {
            //Check Status của đơn hàng
            if ($row["Status"] != NULL && $row["Status"] == 0) {
                if ($params['vnp_ResponseCode'] == '00') {
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                    $returnData['Signature'] = $secureHash;
                    $Status = 1; // Trạng thái đơn hàng thành công
                    
                } else {
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                    $returnData['Signature'] = $secureHash;
                    $Status = 2; // Trạng thái đơn hàng Lỗi
                }
                $update = "UPDATE `orders` SET `vnp_PayDate`='" . sql_escape($params['vnp_PayDate']) . "',`vnp_TransactionNo`='" . sql_escape($vnpTranId) . "',`Status`='".sql_escape($Status)."' WHERE `OrderId`=" . sql_escape($Id);
                if ($conn->query($update) === TRUE) {
                    $log->info("Update record created successfully");
                } else {
                    $log->info("Error: " . $update . "<br>" . $conn->error);
                }
            } else {
                $returnData['RspCode'] = '02';
                $returnData['Message'] = 'Order already confirmed'; // Đơn hàng đã được confirm
            }
        } else {
            $returnData['RspCode'] = '97';
            $returnData['Message'] = 'Chu ky khong hop le';
            $returnData['Signature'] = $secureHash;
        }
    } else {
        $returnData['RspCode'] = '01';
        $returnData['Message'] = 'Order not found'; // Đơn hàng confirm không tồn tại
    }
} catch (Exception $e) {
    $returnData['RspCode'] = '99';
    $returnData['Message'] = 'Unknow error'; // Lỗi khác, lỗi hệ thống
}
mysqli_close($conn);
$log->info("Connected close");
$log->info("END IPNURL");
echo json_encode($returnData);
