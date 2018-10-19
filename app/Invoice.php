<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = 'invoices';

    
    public function customers(){
        return $this->belongsTo('App\Customer' , 'inv_cust');
    }
    

    public function items(){
        return $this->hasMany('App\Item' , 'item_invoice');
    }

    protected $fillable=['inv_cust','inv_total'];
}
