@extends('layouts.master')

@section('content')
<section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add New Invoice</h3>
            </div>
            <!-- /.box-header -->
            
                <div class="row"><div class="retMsg alert_error col-lg-6 "></div></div>

                {!! Form::open(['url'=> route('invoices.store') ,'id'=>'invoiceForm' ]) !!}
                        <div class="box-body">

                            <div class="form-group col-lg-6 {{$errors->has('cust_name') ? 'has-error' : '' }}">
                                {!! Form::label('name','Customer Name') !!}
                                {!! Form::select('inv_cust', [], null, ['placeholder'=>'Customer Name' , 'id'=>"inv_cust" , 'class'=>'form-control' ]) !!}
                            </div>

                            


<!-- /.box-header -->
<div class="box-body">
    <table class="table table-bordered" id='invoiceTable'>
    <tr>
        
        <th style="width:250px;">
            {!! Form::label('product','Product') !!}
            <br>
            {!! Form::select('', [], null, [ 'id'=>"productsSelect" , 'class'=>'form-control' ]) !!}
        </th>
        <th>
            {!! Form::label('name','QTY') !!}
            {!! Form::number('qtyInput','1',['class'=>"form-control" , 'id'=>'qtyInput' ]) !!}
        </th>
        <th>
            {!! Form::label('price','Price') !!}
            {!! Form::number('priceInput','',['class'=>"form-control" ,'id'=>"priceInput" ]) !!}
        </th>
        <th>
            {!! Form::label('total','Total') !!}
            {!! Form::number('totalInput','',['class'=>"form-control" , 'placeholder'=>'total' , 'id'=>"totalInput" , 'readonly'=>'readonly' ]) !!}
        </th>
        <th>{!! Form::label('','#') !!}
            <a href="javascript:;" class="btn btn-primary form-control" id="add_itemsBtn"><i class="fa fa-plus"></i> Add Item</a></th>
    </tr>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td>
            {!! Form::label('total','Total') !!}
            {!! Form::number('invoiceTotal','',['class'=>"form-control" , 'placeholder'=>'total' , 'id'=>"invoiceTotal" , 'readonly'=>'readonly' ]) !!}
            </td>
            <td></td>

        </tr>
    </tfoot>
    </table>
</div>
<!-- /.box-body -->



                        </div>

                            <div class="box-footer">
                                {!! Form::submit('Add New Invoice' , ['class'=>'btn btn-primary','id'=>'addInvoiceBtn' ]) !!}     
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


@push('select2css') 

<link rel="stylesheet" href="{{url('adminlte')}}/bower_components/select2/dist/css/select2.min.css">

@endpush


@push('select2js') 
<script src="{{url('adminlte')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  
  $(function () {
$("#inv_cust").select2({
	allowClear: true
	,placeholder: "Choose Customer.."
  ,ajax: {
    url: "{{url('load_customers')}}",
    dataType: 'json',
    type:'get',
	//delay: 250,
    data: function (params) {
      return {
        q: params.term, //search term
        page: params.page
      };
    },
    processResults: function (data, params) {
	  params.page = params.page || 1;
		//console.log(data);
		//console.log(JSON.stringify(data));
      return {
        results: data,
        //pagination: {
          //more: (params.page * 30) < data.total_count
        //}
      };
    },
    cache: true
  }
   //,escapeMarkup: function (markup) { return markup; } // let our custom formatter work
   //,minimumInputLength: 1
   //,templateResult: formatRepo, // omitted for brevity, see the source of this page
   //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
});



$("#productsSelect").select2({
	allowClear: true
	,placeholder: "Add item.."
  ,ajax: {
    url: "{{url('load_products')}}",
    dataType: 'json',
    type:'get',
	//delay: 250,
    data: function (params) {
      return {
        q: params.term, //search term
        page: params.page
      };
    },
    processResults: function (data, params) {
	  params.page = params.page || 1;
		//console.log(data);
		//console.log(JSON.stringify(data));
      return {
        results: data,
        //pagination: {
          //more: (params.page * 30) < data.total_count
        //}
      };
    },
    cache: true
  }
   //,escapeMarkup: function (markup) { return markup; } // let our custom formatter work
   //,minimumInputLength: 1
   //,templateResult: formatRepo, // omitted for brevity, see the source of this page
   //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
});

$('#productsSelect').on('select2:select', function (e) {
    var data = e.params.data;
    //console.log(data);
    $('#priceInput').val(data.product_price);
    if( $('#qtyInput').val()=='' ){
        $('#qtyInput').val(1);
    }
    
    $('#totalInput').val(data.product_price * parseInt($('#qtyInput').val(),10));

});

$('#priceInput,#qtyInput').change(function(){
    $('#totalInput').val(parseFloat($('#priceInput').val()) * parseInt($('#qtyInput').val(),10));
});

var itemIndex=0;
$('#add_itemsBtn').on('click',function(){
    if($('#qtyInput').val() =='' || $('#priceInput').val()==''){return false;}

    var productsSelect = $('#productsSelect').select2('data');
    //alert(productsSelect[0].text);
    //alert(productsSelect[0].id);

    itemIndex++;
    var ret="<tr>";
        ret+="<td><input name='itemIndex[]' type='hidden' value='"+itemIndex+"'>";
        ret+="<input name='product_id["+itemIndex+"]' type='hidden' value='"+productsSelect[0].id+"'>" + productsSelect[0].text;
        ret+="</td>";
        ret+="<td>"
        ret+="<input name='qty["+itemIndex+"]' type='hidden' value='"+$('#qtyInput').val()+"'>"+$('#qtyInput').val();
        ret+="</td>";
        ret+="<td>";
        ret+="<input name='price["+itemIndex+"]' type='hidden' value='"+$('#priceInput').val()+"'>"+$('#priceInput').val();
        ret+="</td>";
        ret+="<td>";
        ret+="<input name='total["+itemIndex+"]' type='hidden' value='"+$('#totalInput').val()+"' class='hiddenItemTotal'>"+$('#totalInput').val();
        ret+="</td>";
        ret+="<td><a href='javascript:;' class='btn btn-danger remove_itemBtn'><i class='fa fa-trash'></i></a></td>";
    ret+="</tr>";
    $('#invoiceTable').append(ret);
    calc_invoice_total();
    
});

$(document).on('click','.remove_itemBtn',function(e){
	e.preventDefault();
    $(this).parents('tr').remove();
    calc_invoice_total();
});


function calc_invoice_total(){
      var total = 0;
      $('.hiddenItemTotal').each(function(i,n){
        total += parseFloat($(n).val()); 
      });
      $('#invoiceTotal').val(total);
}







    $(document).on("click","#addInvoiceBtn",function(e){
            e.preventDefault();
            var form = $("#invoiceForm").serialize();
            var url = $("#invoiceForm").attr("action");

            $.ajax({
                url : url ,
                data : form ,
                dataType : "json" ,
                type : "post" ,
                beforeSend : function(){
                    $(".alert_error ul").empty();
                },
                success : function(data){
                    if(typeof data.errors !=='undefined'){
                        var error_list="<div class='alert alert-danger alert-dismissible'>";
                            error_list+="<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                            error_list+="<h4><i class='icon fa fa-ban'></i> Error!</h4>";
                            error_list+="<ul>";
                            $.each(data.errors , function(index,v){
                                error_list+= "<li>"+ v + "</li>";
                            } );
                            error_list+="</ul></div>";
                        $(".retMsg").html(error_list);
                    }
                    
                    if(typeof data.success !== 'undefined' ){
                        if(typeof data.id !== 'undefined' ){
                            window.location="{{url('invoices')}}"+"/"+data.id;
                        }
                    }
                   
                    
                    

                },
                error : function(error_data,exception){
                    if(exception == "error"){
                        $(".alert_error").html(error_data.responseJSON.error.msg);
                        var error_list ="";
                        $.each(error_data.responseJSON.error , function(index,v){
                            error_list = "<li>"+ v + "</li>";
                        } );
                        $(".alert_error ul").append(error_list);
                        }
                    }
            });
    });












    
});


</script>  
@endpush
