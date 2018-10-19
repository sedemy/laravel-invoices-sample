@extends('layouts.master')

@section('content')
<section class="content">
      <div class="row">
        <div class="col-lg-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add New Customer</h3>
            </div>
            <!-- /.box-header -->
            
            @if($errors->all())
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <ul>     
                @foreach($errors->all() as $e)
                    <li>{{$e}}</li>
                @endforeach
                </ul>
                </div>
            @endif

                {!! Form::open(['url'=> route('customers.store') ]) !!}
                        <div class="box-body">
                            <div class="form-group {{$errors->has('cust_name') ? 'has-error' : '' }}">
                                {!! Form::label('name','Customer Name') !!}
                                {!! Form::text('cust_name',old('cust_name'),['class'=>"form-control" , 'placeholder'=>'Customer Name' ]) !!}
                            </div>
                            <div class="form-group {{$errors->has('cust_mobile') ? 'has-error' : '' }}">
                                {!! Form::label('mobile','Customer Mobile') !!}
                                {!! Form::text('cust_mobile',old('cust_mobile'),['class'=>"form-control" , 'placeholder'=>'Customer Mobile' ]) !!}
                            </div>
                            <div class="form-group {{$errors->has('cust_email') ? 'has-error' : '' }}">
                                {!! Form::label('email','Customer Email') !!}
                                {!! Form::text('cust_email',old('cust_email'),['class'=>"form-control" , 'placeholder'=>'Customer Email' ]) !!}
                            </div>
                            <div class="form-group {{$errors->has('cust_address') ? 'has-error' : '' }}">
                                {!! Form::label('address','Customer Address') !!}
                                {!! Form::text('cust_address',old('cust_address'),['class'=>"form-control" , 'placeholder'=>'Customer Address' ]) !!}
                            </div>
                        </div>

                            <div class="box-footer">
                                {!! Form::submit('Add Customer' , ['class'=>'btn btn-primary']) !!}     
                            </div>
                {!! Form::close() !!}

                


                    

              
            </div>
            <!-- /.box-body -->
                
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>






@endsection