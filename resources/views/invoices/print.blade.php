<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('adminlte')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('adminlte')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('adminlte')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adminlte')}}/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  
    
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <i class="fa fa-print"></i> Invoice #{{$det->id}}
            <small class="pull-right">Date: {{$det->created_at}}</small>
          </h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Customer
          <address>
            <strong>{{ (!empty($det->customers->cust_name)) ? $det->customers->cust_name : ''}}.</strong><br>
            {{ (!empty($det->customers->cust_mobile)) ? "Mobile : ".$det->customers->cust_mobile : ''}}<br>
            {{ (!empty($det->customers->cust_address)) ? "Address : ".$det->customers->cust_address : ''}}<br>
            {{ (!empty($det->customers->cust_email)) ? "Email : ".$det->customers->cust_email : ''}}<br>
          </address>
        </div>
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              @for($i=0 ; $i < count($items) ; $i++)
              <tr>
                <td>{{ $items[$i]->item_qty }}</td>
                <td>{{ (!empty($items[$i]->product->product_name)) ? $items[$i]->product->product_name : '' }}</td>
                <td>{{$items[$i]->item_price}}</td>
                <td>{{$items[$i]->item_total}}</td>
              </tr>
              @endfor
              <tr>
                <td colspan="3"></td>
                <td><strong>Total</strong></td>
              </tr>
              <tr>
                <td colspan="3"></td>
                <td>{{$det->inv_total}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



</div>
<!-- ./wrapper -->
</body>
</html>
