<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
    public function productadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'productname' => 'required',
            'supplierid' => 'required',
            'categoryid' => 'required',
            'unit' => 'required',
            'price' => 'required'
            
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $product = new Product;
        $product->productname=$request->productname;
        $product->supplierid=$request->supplierid;
        $product->categoryid=$request->categoryid;
        $product->unit=$request->unit;
        $product->price=$request->price;
        $product->save();

        return response()->json([
            'error' => false,
            'product'  => $product,
        ], 200);
    }

    public function productlist(){
        $product = Product::get();
        return response()->json(['message'=>'Successfully','product'=>$product,'status'=>200]);
    }
    public function productbyid($id){
        if(Product::where('id',$id)->exists()){
            $product = Product::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'product'=>$product]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function productupdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(),[ 
            'productname' => 'required',
            'supplierid' => 'required',
            'categoryid' => 'required',
            'unit' => 'required',
            'price' => 'required'
           
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Product:: where('id',$id)->exists()){
                $product = Product::find($id);
                $product->productname=$request->productname;
                $product->supplierid=$request->supplierid;
                $product->categoryid=$request->categoryid;
                $product->unit=$request->unit;
                $product->price=$request->price;
                $product->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $product,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200); 
            }
        }

    }
    public function productdelete($id){

        if(Product::where('id',$id)->exists()){
                $product = Product::find($id);
                $product->delete();
                return response()->json(['message'=>'Data deleted successfully','status'=>200]);
            } else {
                return response()->json(['message'=>'Data not found','status'=>404]);
            }
        
        
    }
}
