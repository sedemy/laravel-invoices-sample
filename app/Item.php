<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = "items";

    public function invoices(){
        return $this->belongsTo('App\Invoice' , 'item_invoice');
    }


    public function product(){
        return $this->belongsTo('App\Product' , 'item_product');
    }

}
