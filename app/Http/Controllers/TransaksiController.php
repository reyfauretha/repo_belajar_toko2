<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi; 
use Illuminate\Support\Facades\Validator; 

class TransaksiController extends Controller
{
    public function show()
    {
        $data_transaksi = Transaksi::join('orders','transaksi.id_orders','orders.id')->get();
        return Response()->json($data_transaksi);
    }
    public function detail($id)
    {
        if(Transaksi::where('id_transaksi', $id)->exists()) {
            $data_transaksi = Transaksi::join('orders', 'orders.id_orders', 'transaksi.id_orders')
                                ->where('transaksi.id', '=', $id)
                                ->get();

            return Response()->json($data_transaksi);
        }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }
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
    public function update($id, Request $request)
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
            $ubah = Transaksi::where('id_transaksi', $id)->update([
                    'total_harga' => $request->total_harga,
                    'id_orders' => $request->id_orders 
            ]);
            if($ubah) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
    }

        public function destroy($id)
        {
            $hapus = Transaksi::where('id_transaksi', $id)->delete();
            if($hapus) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
        }
    
}
