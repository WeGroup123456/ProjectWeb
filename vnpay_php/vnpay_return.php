<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <link href="http://se2017s1g9.esy.es/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="http://117.6.131.222/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="http://117.6.131.222/vnpay_php/assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <?php
        require_once("config.php");
        //process return data
        $hashSecret = $vnpay_hash_secret;
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $params = array();
        foreach ($_GET as $key => $value) {
           if(substr($key,0,3)=="vnp")
	       {
			$params[$key] = $value;
		   }
        }
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

        $secureHash = md5($hashSecret . $hashData);


        // $Amount = $_GET['vnp_Amount'];
        // $OrderDescription = $_GET['vnp_OrderInfo'];
        // $IpAddr = "117.6.131.222";
        // $UserAgent = "Mozilla/5.0 (Linux; Android 7.0; BLL-L22 Build/HUAWEIBLL-L22; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.98 Mobile Safari/537.36";
        // $vnp_TransactionNo = $_GET['vnp_TransactionNo'] ;
        // $vnp_TxnResponseCode = $_GET['vnp_ResponseCode'];
        // $vnp_BatchNo = $_POST['city_name'];
        // $vnp_BankCode = $_GET['vnp_BankCode'];
        // $vnp_PayDate = $_GET['vnp_PayDate'];
        // $CreatedDate = $_GET['vnp_PayDate'];
        // if ($secureHash == $vnp_SecureHash) {
        //     if ($_GET['vnp_ResponseCode'] == '00') {
        //         $Status = 1;
        //     } else {
        //         $Status = 0;
        //     }
        // } else {
        //     echo "Chu ky khong hop le";
        // }

        // $sql_query = "INSERT INTO `orders`(`Amount`, `OrderDescription`, `IpAddr`, `UserAgent`, `vnp_TransactionNo`, `vnp_TxnResponseCode`, `vnp_BatchNo`, `vnp_BankCode`, `vnp_PayDate`, `CreatedDate`, `Status`) VALUES ('$Amount','$OrderDescription','$IpAddr','$UserAgent','$vnp_TransactionNo','$vnp_TxnResponseCode','$vnp_BatchNo','$vnp_BankCode','$vnp_PayDate','$CreatedDate','$Status')";
        // if (mysql_query($sql_query)) {
        //     echo "Success";
        // }else{
        //     echo "Error";
        // }
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY RESPONSE</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $_GET['vnp_Amount'] ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        } else {
                            echo "Chu ky khong hop le";
                        }
                        ?>

                    </label>
                </div>
                 <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
            </div>
            <div style="clear: both"><a href="http://se2017s1g9.esy.es/home">Về trang chủ</a></div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2015</p>
            </footer>
        </div>  
    </body>
</html>
