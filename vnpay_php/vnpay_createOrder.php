<?php
$param='?amount='.$_GET['?amount'].'&user_id='.$_GET['?user_id'];


?>
<div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Tạo mới đơn hàng</h3></div>
<div style="width: 100%" >
    <form action="http://se2017s1g9.esy.es/vnpay_php/vnpay_ajax.php" id="frmCreateOrder" method="post">        
        <div class="form-group">
            <label for="language">Loại hàng hóa </label>
            <select name="ordertype" id="ordertype" class="form-control">
                <option value="topup">Nạp tiền điện thoại</option>
                <option value="billpayment">Thanh toán hóa đơn</option>
                <option value="fashion">Thời trang</option>
            </select>
        </div>
		 <div class="form-group">
            <label for="name">User ID: </label>
            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The userid field is required." id="userid" max="100000000" min="1" name="userid" type="number" value="<?php echo $_GET['user_id']; ?>" />
        </div>
        <div class="form-group">
            <label for="amount">Số tiền</label>
            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="<?php echo $_GET['amount']; ?>" />
        </div>
        <div class="form-group">
            <label for="OrderDescription">Nội dung thanh toán</label>
            <textarea class="form-control" cols="20" id="orderDesc" name="orderDesc" rows="2">Thanh toan don hang test</textarea>
        </div>
        <div class="form-group">
            <label for="bankcode">Ngân hàng</label>
            <select name="bankcode" id="bankcode" class="form-control">
                <option value="">Không chọn </option>
                <option value="NCB">Ngan hang NCB</option>
                <option value="SACOMBANK">Ngan hang SacomBank  </option>
                <option value="EXIMBANK">Ngan hang EximBank </option>
                <option value="MSBANK"> Ngan hang MSBANK </option>
                <option value="NAMABANK"> Ngan hang NamABank </option>
                <option value="VISA">  	Thanh toan qua VISA/MASTER</option>
                <option value="VNMART">  Vi dien tu VnMart</option>
                <option value="VIETINBANK">Ngan hang Vietinbank  </option>
                <option value="VIETCOMBANK"> Ngan hang VCB </option>
                <option value="HDBANK">Ngan hang HDBank</option>
                <option value="DONGABANK">  Ngan hang Dong A</option>
                <option value="TPBANK"> Ngân hàng TPBank </option>
                <option value="OJB">Ngân hàng OceanBank</option>
                <option value="BIDV"> Ngân hàng BIDV </option>
                <option value="TECHCOMBANK"> Ngân hàng Techcombank </option>
                <option value="VPBANK"> Ngan hang VPBank </option>
                <option value="AGRIBANK"> Ngan hang Agribank </option>
                <option value="MBBANK"> Ngan hang MBBank </option>
                <option value="ACB"> Ngan hang ACB </option>
                <option value="OCB"> Ngan hang OCB </option>
            </select>
        </div>

        <div class="form-group">
            <label for="language">Ngôn ngữ</label>
            <select name="language" id="language" class="form-control">
                <option value="vn">Tiếng Việt</option>
                <option value="en">English</option>
            </select>
        </div>
        <input type="submit" name="popup" id="popup" class="btn btn-default" value="Thanh toán Popup" />
        <input type="submit" name="redirect" class="btn btn-default" value="Thanh toán Redirect" />
    </form>
</div>
<link href="https://pay.vnpay.vn/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://pay.vnpay.vn/lib/vnpay/vnpay.js"></script>
<script type="text/javascript">
    $("#popup").click(function () {
        var postData = $("#frmCreateOrder").serialize();
		console.log(postData)
        var submitUrl = $("#frmCreateOrder").attr("action");		
        $.ajax({
            type: "POST",
            url: submitUrl,
			
            data: postData,
            dataType: 'JSON',
            success: function (x) {
                if (x.code === '00') {
                    if (window.vnpay)
                    {
                        vnpay.open({width: 480, height: 600, url: x.data});
                    } else
                    {
                        window.location.href = x.data;
                    }
                    return false;
                } else {
                    alert(x.Message);
                }
            }
        });
        return false;
    });
</script>