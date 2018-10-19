@extends('layouts.master')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Invoices list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Invoice No.</th>
                  <th>Customer</th>
                  <th>Amont</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i < count($invoices);$i++)
                <tr>
                  <td>#{{$invoices[$i]->id}}</td>
                  <td>{{$invoices[$i]->customers->cust_name}}</td>
                  <td>{{$invoices[$i]->inv_total}}</td>
                  <td>
                      <a href="{{url('invoices/'.$invoices[$i]->id)}}" class="btn btn-default margin-right"><i class="fa fa-eye"></i> Show Invoice</a>
                      <a href="{{url('invoices/print/'.$invoices[$i]->id)}}" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice</a>
                  </td>
                </tr>
                @endfor
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
                <div class="box-footer clearfix">{!! $invoices->render() !!}</div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>












@endsection