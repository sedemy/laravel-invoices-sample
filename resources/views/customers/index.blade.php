@extends('layouts.master')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Customers List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i < count($cust);$i++)
                <tr>
                  <td>{{$cust[$i]->cust_name}}</td>
                  <td>{{$cust[$i]->cust_mobile}}</td>
                  <td>{{$cust[$i]->cust_email}}</td>
                  <td>{{$cust[$i]->cust_address}}</td>
                  <td>
                      <a href="{{url('customers/'.$cust[$i]->id.'/edit')}}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                      <a href="javascript:;" class="btn btn-danger"
                      onclick=" if(confirm('Are you sure?')){
                      event.preventDefault(); document.getElementById('{!! 'frm'.$cust[$i]->id !!}').submit();
                      }"
                      ><i class="fa fa-trash"></i> Delete</a>


                      {!! Form::open(['url'=> route('customers.destroy' , $cust[$i]->id ) , 'method'=>'DELETE' , 'id'=>'frm'.$cust[$i]->id ]) !!}
                          {!! Form::submit('' , ['style'=>'display:none']) !!}
                        {!! Form::close() !!}
                  </td>
                </tr>
                @endfor
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
                <div class="box-footer clearfix">{!! $cust->render() !!}</div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>












@endsection