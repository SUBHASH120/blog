<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Order;

class OrderController extends Controller
{
    public function orderadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'customerid' => 'required',
            'employeeid' => 'required',
            'orderdate' => 'required',
            'shipperid' => 'required',
            
            
            
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $order = new Order;
        $order->customerid=$request->customerid;
        $order->employeeid=$request->employeeid;
        $order->orderdate=$request->orderdate;
        $order->shipperid=$request->shipperid;
        $order->save();

        return response()->json([
            'error' => false,
            'product'  => $product,
        ], 200);
    }

    public function orderlist(){
        $order = Order::get();
        return response()->json(['message'=>'Successfully','order'=>$order,'status'=>200]);
    }
    public function orderbyid($id){
        if(Order::where('id',$id)->exists()){
            $order = Order::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'order'=>$order]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function orderupdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(),[ 
            'customerid' => 'required',
            'employeeid' => 'required',
            'orderdate' => 'required',
            'shipperid' => 'required',
           
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Order:: where('id',$id)->exists()){
                $order = Order::find($id);
                $order->customerid=$request->customerid;
                $order->employeeid=$request->employeeid;
                $order->orderdate=$request->orderdate;
                $order->shipperid=$request->shipperid;
                $order->save();
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
    public function orderdelete($id){

        if(Order::where('id',$id)->exists()){
                $order = Order::find($id);
                $order->delete();
                return response()->json(['message'=>'Data deleted successfully','status'=>200]);
            } else {
                return response()->json(['message'=>'Data not found','status'=>404]);
            }
        
        
    }
}
