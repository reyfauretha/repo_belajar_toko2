<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';     
    public $timestamps = false; 
 
    protected $fillable = ['tanggal','jumlah','id_customers','id_product']; 
}
