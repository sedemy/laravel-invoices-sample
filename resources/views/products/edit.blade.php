@extends('layouts.master')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-lg-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Product</h3>
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

                {!! Form::open(['url'=> route('products.update',$det->id) , 'method'=>'PUT' ]) !!}
                        <div class="box-body">
                            <div class="form-group {{$errors->has('product_name') ? 'has-error' : '' }}">
                                {!! Form::label('name','Product Name') !!}
                                {!! Form::text('product_name',$det->product_name,['class'=>"form-control" , 'placeholder'=>'Product Name' ]) !!}
                            </div>
                            <div class="form-group {{$errors->has('product_desc') ? 'has-error' : '' }}">
                                {!! Form::label('product_desc','Description') !!}
                                {!! Form::text('product_desc',$det->product_desc,['class'=>"form-control" , 'placeholder'=>'Description' ]) !!}
                            </div>
                            <div class="form-group {{$errors->has('product_price') ? 'has-error' : '' }}">
                                {!! Form::label('product_price','Default Price') !!}
                                {!! Form::number('product_price',$det->product_price,['class'=>"form-control" , 'placeholder'=>'Price' ]) !!}
                            </div>
                        </div>

                            <div class="box-footer">
                                {!! Form::submit('Update Product..' , ['class'=>'btn btn-primary']) !!}     
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