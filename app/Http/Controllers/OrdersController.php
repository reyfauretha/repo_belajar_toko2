<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders; 
use Illuminate\Support\Facades\Validator; 

class OrdersController extends Controller
{
    public function show()
    {
        $data_orders = Orders::join('customers','orders.id_customers','customers.id')
                        ->join('product','orders.id_product','product.id')
                        ->get();
        return Response()->json($data_orders);
    }
    public function detail($id)
    {
        if(Siswa::where('id', $id)->exists()) {
            $data_orders = Orders::join('customers', 'customers.id_customers', 'orders.id_customers')
                                ->where('orders.id', '=', $id)
                                ->get();

            return Response()->json($data_orders);
        }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }
    public function store(Request $request)     
    { 
        $validator=Validator::make($request->all(),             
            [                 
                'tanggal' => 'required',
                'jumlah' => 'required', 
                'id_customers' => 'required',
                'id_product' => 'required'            
            ]         
        ); 
    
        if($validator->fails()) {             
                return Response()->json($validator->errors());         
        } 
    
        $simpan = Orders::create([             
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'id_customers' => $request->id_customers,
                'id_product' => $request->id_product    
                ]); 
    
        if($simpan) {             
            return Response()->json(['status'=>1]);         
        }         
        else {             
            return Response()->json(['status'=>0]);         
        }     
    }
    public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
                'tanggal' => 'required',
                'jumlah' => 'required', 
                'id_customers' => 'required',
                'id_product' => 'required'  
        ]
    );
        if($validator->fails()) {
            return Response()->json($validator->errors());
    }
        $ubah = Orders::where('id_orders', $id)->update([
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'id_customers' => $request->id_customers,
                'id_product' => $request->id_product  
        ]);
        if($ubah) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    } 
}
