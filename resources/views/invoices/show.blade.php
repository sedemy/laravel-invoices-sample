@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <i class="fa fa-globe"></i> Invoice #{{$det->id}}
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{ url('invoices/print/'.$det->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>






@endsection