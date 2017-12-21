<div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Chi tiết</h3></div>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once("config.php");
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$ma =  sql_escape(($_GET['id']));
$result = $conn->query("SELECT * FROM `orders` WHERE OrderId='".$ma."'") or die("Lỗi không có mã tin này");
$row = $result->fetch_object();
if ($row != "") {
    echo '<p style="color: #333333"><strong> Mã đơn hàng :</strong> ' . $row->OrderId . '</p>';
    echo '<p style="color: #333333"><strong>Số tiền: </strong> ' . $row->Amount . '</p>';
    echo '<p style="color: #333333"><strong>Nội dung thanh toán :</strong> ' . $row->OrderDescription . '</p>';
    $status = $row->Status;
    $trangthai = "";
    switch ($status) {
        case 1:
            $trangthai = "Đã thanh toán ";
            break;
        case 2:
            $trangthai = "GD Lỗi";
        default:
            $trangthai = "Chưa thanh toán!";
    }
    echo '<p style="color: #333333"><strong>Trạng thái :</strong> ' . $trangthai . '</p>';
}
?>
<div style="clear: both"><a href="index.php">Về danh sách</a></div>
