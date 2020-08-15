<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi; 
use Illuminate\Support\Facades\Validator; 

class TransaksiController extends Controller
{
    public function store(Request $request)     
    { 
        $validator=Validator::make($request->all(),             
            [                 
                'total_harga' => 'required',
                'id_orders' => 'required'   
            ]         
        ); 
    
        if($validator->fails()) {             
                return Response()->json($validator->errors());         
        } 
    
        $simpan = Transaksi::create([             
                'total_harga' => $request->total_harga,
                'id_orders' => $request->id_orders    
                ]); 
    
        if($simpan) {             
            return Response()->json(['status'=>1]);         
        }         
        else {             
            return Response()->json(['status'=>0]);         
        }     
    }
}
