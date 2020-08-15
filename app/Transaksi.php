<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';     
    public $timestamps = false; 
 
    protected $fillable = ['total_harga','id_orders']; 
}
