<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Validator;
use DB;
class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cust=Customer::orderBy('id','desc')->paginate(10);
        
        return view('customers.index' , ['cust'=>$cust ,'MenuOpen'=>'customers','MenuActive'=>'customersIndex']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create', ['MenuOpen'=>'customers','MenuActive'=>'customersCreate']);
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
            ['cust_name' => 'required'
            ,'cust_email' => 'required|email|unique:customers'
            ]
        ,
        [],
        ['cust_name'=> 'Customer Name' , 'cust_email'=> 'Customer Email']
        );
        
        $cust= new Customer;
        $cust->cust_name = request('cust_name');
        $cust->cust_email = request('cust_email');
        $cust->cust_mobile = request('cust_mobile');
        $cust->cust_address= request('cust_address');

        $cust->save();

        return redirect('customers');
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
        $det = Customer::find($id);
        if(empty($det)){
            return redirect('/');
        }
        return view('customers.edit',['det'=>$det ,'MenuOpen'=>'customers' ]);
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
            ['cust_name' => 'required'
            ,'cust_email' => 'required|email|unique:customers,cust_email,'.$id
            ]
        ,
        [],
        ['cust_name'=> 'Customer Name' , 'cust_email'=> 'Customer Email']
        );
        
        $cust=Customer::find($id);

        if(empty($cust)){
            return redirect('/');
        }

        $cust->cust_name = request('cust_name');
        $cust->cust_email = request('cust_email');
        $cust->cust_mobile = request('cust_mobile');
        $cust->cust_address= request('cust_address');

        $cust->save();

        return redirect('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cust=Customer::find($id);

        if(empty($cust)){
            return redirect('/');
        }

        $cust->delete();

        return back();
    }

    
    public function load_customers(Request $request){
        
        $q = trim($request->q);
        $c=DB::table('customers')
        ->select('id','cust_name as text')
        ->where('cust_name','like',"%".$q."%")
        ->orderBy('cust_name','desc')->get();
        
        return response()->json($c);
    }
    
}
