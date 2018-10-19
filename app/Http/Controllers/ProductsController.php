<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;
use DB;
class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id','desc')->paginate(10);
        
        return view('products.index' , ['products'=>$products ,'MenuOpen'=>'products','MenuActive'=>'productsIndex']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', ['MenuOpen'=>'products','MenuActive'=>'productsCreate']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(),
            ['product_name' => 'required']
        ,
        [],
        ['product_name'=> 'Product Name']
        );
        
        $product= new Product;
        $product->product_name= request('product_name');
        $product->product_desc= request('product_desc');
        $product->product_price= request('product_price');

        $product->save();

        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $det = Product::find($id);
        if(empty($det)){
            return redirect('/');
        }
        return view('products.edit',['det'=>$det ,'MenuOpen'=>'products' ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),
            ['product_name' => 'required']
        ,
        [],
        ['product_name'=> 'Product Name']
        );
        
        $product=Product::find($id);

        if(empty($product)){
            return redirect('/');
        }

        $product->product_name= request('product_name');
        $product->product_desc= request('product_desc');
        $product->product_price= request('product_price');

        $product->save();

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);

        if(empty($product)){
            return redirect('/');
        }

        $product->delete();

        return back();
    }


    public function load_products(Request $request){
        
        $q = trim($request->q);
        $c=DB::table('products')
        ->select('id','product_name as text','product_price','product_desc')
        ->where('product_name','like',"%".$q."%")
        ->orderBy('product_name','desc')->get();
        
        return response()->json($c);
    }

}



