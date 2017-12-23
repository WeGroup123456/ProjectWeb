<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once("config.php");
// New Connection
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$viewbag = "Danh sách đơn hàng";
?>
<div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Danh sách đơn hàng</h3></div>
<div style="height: 50px;padding-top: 10px">
    <?php
    if (isset($_GET['rescode'])) {
        $res = $_GET['rescode'];
        switch ($res) {
            case 00:
                echo "Giao dịch được thực hiện thành công. Cảm ơn quý khách đã sử dụng dịch vụ";
                break;
            case 01:
                echo "Giao dịch bị lỗi trong quá trình xử lý";
                break;
            case 02:
                echo "<p style='color:red'>Không tìm thấy giao dịch</p>";
                break;
            case 03:
                echo "<p style='color:red'>Giao dịch không thành công do sai chữ ký</p>";
                break;
            default:
        }
    }
    ?>
</div>
<div class="pager" style="margin: 0 auto">
    <?php
    //phan trang
    $result = $conn->query("SELECT COUNT(*) as Num FROM `orders`");
    $row = $result->fetch_assoc();
    $total_results = intval($row["Num"]);
    $total_pages = ceil($total_results / $max_results);
    echo "<center>";
    if ($page > 1) {
        $prev = ($page - 1);
        echo "<a  href=\"" . $_SERVER['PHP_SELF'] . "?page=$prev\"><<</a>";
    }
    if ($page == 1) {
        $prev = ($page - 1);
        echo "<span class='disabled'><<</span>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if (($page) == $i) {
            echo "<span class='current'>$i</span>";
        } else {
            echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?page=$i\">$i</a>";
        }
    }
    if ($page < $total_pages) {
        $next = ($page + 1);
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?page=$next\">>></a>";
    }
    if ($page == $total_pages) {
        echo "<span class='disabled'>>></span>";
    }
    echo "</center>";
    ?> 
</div>
<div style="width: 100%">
    <table class="table table-bordered" style="font-size: 14px;margin-top: 10px">
        <thead >
        <th>Mã</th>
        <th>Số tiền</th>
        <th>Nội dung</th>
        <th>Ngày tạo</th>
        <th>Tình trạng</th>
        <th>IpAddr</th>
        <th>Action</th>
        <th>Query</th>
        </thead>
        <?php
        $sql = "SELECT * FROM `orders` ORDER BY OrderId DESC LIMIT $from, $max_results";
        $rev = $conn->query($sql) or die("Not sql");
        if ($rev->num_rows > 0) {
            while ($row = $rev->fetch_object()) {

                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $row->OrderId . '</td>';
                echo '<td>' . $row->Amount . '</td>';
                echo '<td>' . $row->OrderDescription . '</td>';
                echo '<td>' . $row->CreatedDate . '</td>';
                echo '<td>';
                $status = $row->Status;
                switch ($status) {
                    case 1:
                        echo "Đã thanh toán ";
                        break;
                    case 2:
                        echo "GD Lỗi";
                    default:
                        echo "Chưa thanh toán!";
                }
                echo '</td>';
                echo '<td>' . $row->IpAddr . '</td>';
                echo '<td><a href=\'index.php?url=vnpay_orderdetail&&id=' . $row->OrderId . '\'>Chi tiết</a></td>';
                echo '<td><a href=\'index.php?url=vnpay_query&&id=' . $row->OrderId . '\'>Query</a></td>';
                echo '</tr>';
                echo '</tbody>';
            }
        }
        ?>

    </table>
</div>
<div class="pager" style="margin:5px auto;">
    <?php
    $result = $conn->query("SELECT COUNT(*) as Num FROM `orders`");
    $row = $result->fetch_assoc();
    $total_results = $row["Num"];
    $total_pages = ceil($total_results / $max_results);
    echo "<center>";
    if ($page > 1) {
        $prev = ($page - 1);
        echo "<a  href=\"" . $_SERVER['PHP_SELF'] . "?page=$prev\"><<</a>";
    }
    if ($page == 1) {
        $prev = ($page - 1);
        echo "<span class='disabled'><<</span>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if (($page) == $i) {
            echo "<span class='current'>$i</span>";
        } else {
            echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?page=$i\">$i</a>";
        }
    }
    if ($page < $total_pages) {
        $next = ($page + 1);
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?page=$next\">>></a>";
    }
    if ($page == $total_pages) {
        echo "<span class='disabled'>>></span>";
    }
    echo "</center>";
    mysqli_close($conn);
    ?> 
</div>