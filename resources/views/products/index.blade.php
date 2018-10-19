@extends('layouts.master')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Default Price</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i < count($products);$i++)
                <tr>
                  <td>{{$products[$i]->product_name}}</td>
                  <td>{{$products[$i]->product_desc}}</td>
                  <td>{{$products[$i]->product_price}}</td>
                  <td>
                      <a href="{{url('products/'.$products[$i]->id.'/edit')}}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                      <a href="javascript:;" class="btn btn-danger"
                      onclick=" if(confirm('Are you sure?')){
                      event.preventDefault(); document.getElementById('{!! 'frm'.$products[$i]->id !!}').submit();
                      }"
                      ><i class="fa fa-trash"></i> Delete</a>


                      {!! Form::open(['url'=> route('products.destroy' , $products[$i]->id ) , 'method'=>'DELETE' , 'id'=>'frm'.$products[$i]->id ]) !!}
                          {!! Form::submit('' , ['style'=>'display:none']) !!}
                        {!! Form::close() !!}
                  </td>
                </tr>
                @endfor
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
                <div class="box-footer clearfix">{!! $products->render() !!}</div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>












@endsection