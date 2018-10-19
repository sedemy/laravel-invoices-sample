<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    public $table = "customers";
    
    public function invoices(){
        return $this->hasMany('App\Invoice' , 'inv_cust');
    }

}
