@section('title')
  Check order
@endsection
@extends('layout.index')
@section('content')
<div class="container" style="height:80vh;">
  <div style="width: 100%; margin-top: 50px;">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center" style="background-color: #f7544a;">
                <th>Mã</th>
                <th>Số tiền</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
          <tr class="odd gradeX" align="center">
              @if ($order != null)
                <td>{{$order->vnp_TransactionNo}}</td>
                <td>{{$order->Amount}}</td>
                <td>{{$order->OrderDescription}}</td>
                <td>{{$order->CreatedDate}}</td>
                @if ($order->Status == 1)
                  <td class="alert alert-success" style="background-color: green; color: #fff;">Đã thanh toán</td>
                @elseif ($order->Status == 2)
                  <td class="alert alert-danger" style="background-color: red; color: #fff;">Giao dịch lỗi</td>
                @else
                  <td class="alert alert-danger" style="background-color: blue; color: #fff;">Chưa thanh toán</td>
                @endif
              @else
                <td colspan="5">No data!</td>
              @endif
              
          </tr>
        </tbody>
    </table>
</div>
</div>
@endsection