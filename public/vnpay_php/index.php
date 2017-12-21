<!DOCTYPE html>
<html>
    <head>
        <title><?php
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            $title = $_GET['url'];
            switch ($title) {
                case "vnpay_orderList":
                    echo "Danh sách sản phẩm";
                    break;
                case "vnpay_createOrder":
                    echo "Tạo mới đơn hàng";
                     break;
                case "vnpay_query":
                    echo "Querydr";
                    break;
                case "vnpay_refund":
                    echo "Refund";
                    break;
                default:
                    echo "Danh sách sản phẩm";
            }
            ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="assets/jquery-1.11.3.min.js"></script>
        <?php
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $max_results = 10;
        $from = (($page * $max_results) - $max_results);
        ?>
    </head>
    <body>
        <div style="margin:0 auto;width: 940px;">
            <div style="width: 100%">
                <div style="width: 200px;float: left;color: #777777"><h3 style="font-weight: normal">VNPAY DEMO</h3></div>
                <div style="width: 700px;float: right">
                    <div style="float: right;padding-top: 10px;padding-left: 200px">
                        <a class="btn btn-default" href="index.php?url=vnpay_orderList" type="submit">Danh sách</a>
                        <a class="btn btn-default" href="index.php?url=vnpay_createOrder" type="submit">Tạo mới</a>
                        <a class="btn btn-default" href="index.php?url=vnpay_query" type="submit">Querydr</a>
                        <a class="btn btn-default" href="index.php?url=vnpay_refund" type="submit">Refund</a>
                    </div>
                </div>
            </div>
            <hr style="clear: both">
            <?php
            $link = $_GET['url'];
            if (isset($_GET['url'])) {
                include_once ($link . '.php');
            } else {
                include_once ('vnpay_orderList.php');
            }
            ?>
            <hr>
            <a href="OrdersDetail.php?id="></a>
            <div style="width:100%"><div style="margin:10px auto;text-align: center">© VNPAY 2015</div></div>
        </div>
    </body>
</html>