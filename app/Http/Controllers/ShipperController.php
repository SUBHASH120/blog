<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Shipper;

class ShipperController extends Controller
{
    public function shipperadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'shippername' => 'required',
            'phone' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $shipper = new Shipper;
        $shipper->shippername = $request->shippername;
        $shipper->phone = $request->phone;
        $shipper->save();

        return response()->json([
            'error' => false,
            'shipper'  => $shipper,
        ], 200);
    }

    public function shipperlist(){
        $shipper = Shipper::get();
        return response()->json(['message'=>'Successfully','shipper'=>$shipper,'status'=>200]);
    }
    public function shipperbyid($id){
        if(Shipper::where('id',$id)->exists()){
            $shipper = Shipper::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'shipper'=>$shipper]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function shipperupdate(Request $request, $id){

        $validation = Validator::make($request->all(),[ 
            'shippername' => 'required',
            'phone' => 'required'
           
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Shipper:: where('id',$id)->exists()){
                $shipper = Shipper::find($id);
                $shipper->shippername=$request->shippername;
                $shipper->phone=$request->phone;
                $shipper->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $shipper,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);            }

        }

    }

    
    public function shipperdelete($id){

        if(Shipper::where('id',$id)->exists()){
            $shipper = Shipper::find($id);
            $shipper->delete();
            return response()->json(['message'=>'Data deleted successfully','status'=>200]);
        } else {
            return response()->json(['message'=>'Data not found','status'=>404]);
        }
    
    
    }
}
