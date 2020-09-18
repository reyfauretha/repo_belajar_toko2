<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 
use Illuminate\Support\Facades\Validator; 

class ProductController extends Controller
{
    public function show()
    {
    return Product::all();
    }
    public function store(Request $request)     
    { 
        $validator=Validator::make($request->all(),             
            [                 
                'nama' => 'required',
                'stok' => 'required', 
                'harga' => 'required'              
            ]         
        ); 
    
        if($validator->fails()) {             
                return Response()->json($validator->errors());         
        } 
    
        $simpan = Product::create([             
                'nama' => $request->nama,
                'stok' => $request->stok, 
                'harga' => $request->harga          
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
                'nama' => 'required',
                'stok' => 'required', 
                'harga' => 'required' 
            ]
        );
            if($validator->fails()) {
                return Response()->json($validator->errors());
            }
            $ubah = Product::where('id_product', $id)->update([
                    'nama' => $request->nama,
                    'stok' => $request->stok, 
                    'harga' => $request->harga 
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
            $hapus = Product::where('id_product', $id)->delete();
            if($hapus) {
                return Response()->json(['status' => 1]);
            }
            else {
                return Response()->json(['status' => 0]);
            }
        }
    
}
