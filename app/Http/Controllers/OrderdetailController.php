<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Orderdetail;


class OrderdetailController extends Controller
{
    public function orderdetailadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'orderid' => 'required',
            'productid' => 'required',
            'quantity' => 'required',
            
            
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $orderdetail = new Orderdetail;
        $orderdetail->orderid=$request->orderid;
        $orderdetail->productid=$request->productid;
        $orderdetail->quantity=$request->quantity;
        $orderdetail->save();

        return response()->json([
            'error' => false,
            'product'  => $product,
        ], 200);
    }

    public function orderdetaillist(){
        $orderdetail = Orderdetail::get();
        return response()->json(['message'=>'Successfully','orderdetail'=>$orderdetail,'status'=>200]);
    }
    public function orderdetailbyid($id){
        if(Orderdetail::where('id',$id)->exists()){
            $orderdetail = Orderdetail::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'orderdetail'=>$orderdetail]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function orderdetailupdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(),[ 
            'orderid' => 'required',
            'productid' => 'required',
            'quantity' => 'required',
           
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Orderdetail:: where('id',$id)->exists()){
                $orderdetail = Orderdetail::find($id);
                $orderdetail->orderid=$request->orderid;
                $orderdetail->productid=$request->productid;
                $orderdetail->quantity=$request->quantity;
                $orderdetail->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $orderdetail,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200); 
            }
        }

    }
    public function orderdetaildelete($id){

        if(Orderdetail::where('id',$id)->exists()){
                $orderdetail = Orderdetail::find($id);
                $orderdetail->delete();
                return response()->json(['message'=>'Data deleted successfully','status'=>200]);
            } else {
                return response()->json(['message'=>'Data not found','status'=>404]);
            }
        
        
    }
}
