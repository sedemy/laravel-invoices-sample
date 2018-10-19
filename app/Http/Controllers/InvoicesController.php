<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use DB;
use Validator;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id','desc')->paginate(10);
        
        return view('invoices.index' , ['invoices'=>$invoices ,'MenuOpen'=>'invoices','MenuActive'=>'invoicesIndex']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create', ['MenuOpen'=>'invoices','MenuActive'=>'invoicesCreate']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        if(!$req->ajax()){
            return back();
        }
        $validator=Validator::make($req->all(),
            ['inv_cust'=>'required']
            ,[],['inv_cust'=>'Customer Name']
        );

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if(empty($req->itemIndex) ){
            return response()->json(['errors'=> ['This Invoice has no items'] ]);
        }

        //return response()->json(['success'=>'Record is successfully added']);


        $inv_cust = $req->input('inv_cust');
        $inv_total = $req->input('invoiceTotal');
        $inserted_invoice = Invoice::create(['inv_cust' => $inv_cust , 'inv_total'=>$inv_total]);
        
        $invoice_id = $inserted_invoice->id;
        
        


        if(!empty($req->itemIndex)){
            $itemIndex = $req->itemIndex;
            //print_r($itemIndex);

            if(@is_array($itemIndex)){

                foreach($itemIndex as $index){
                    
                    $addItem= new \App\Item;
                    $addItem->item_invoice=$invoice_id;

                    if(!empty($req->product_id[$index])){
                        //echo "Item ".$index." - ".$req->item_id[$index]."<br>";
                        $addItem->item_product=$req->product_id[$index];
                    }
                    
                    if(!empty($req->price[$index])){
                       // echo "Price ".$index." - ".$req->price[$index]."<br>";
                       $addItem->item_price=$req->price[$index];
                    }
                    if(!empty($req->qty[$index])){
                        //echo "QTY ".$index." - ".$req->qty[$index]."<br>";
                        $addItem->item_qty=$req->qty[$index];
                    }
                    if(!empty($req->total[$index])){
                        //echo "Total ".$index." - ".$req->total[$index]."<br>";
                        $addItem->item_total=$req->total[$index];
                    }

                    $addItem->save();
                    
                }

            }
        }
        //return redirect('invoices');
        return response()->json(['success'=>'Invoice is successfully added' , 'id' => $invoice_id]);
        //return $req;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $det = Invoice::find($id);
        if(empty($det)){
            return redirect('/');
        }
        
        $items = \App\Item::where('item_invoice',$id)->get();

        return view('invoices.show',['det'=>$det , 'items'=>$items ,'MenuOpen'=>'invoices' ]);
    }

    public function print($id)
    {
        $det = Invoice::find($id);
        if(empty($det)){
            return redirect('/');
        }
        
        $items = \App\Item::where('item_invoice',$id)->get();

        return view('invoices.print',['det'=>$det , 'items'=>$items ,'MenuOpen'=>'invoices' ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
