<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Supplier;


class SupplierController extends Controller
{
    public function supplieradd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'suppliername' => 'required',
            'contactname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postalcode' => 'required',
            'country' => 'required',
            'phone' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $supplier = new Supplier;
        $supplier->suppliername=$request->suppliername;
        $supplier->contactname=$request->contactname;
        $supplier->address=$request->address;
        $supplier->city=$request->city;
        $supplier->postalcode=$request->postalcode;
        $supplier->country=$request->country;
        $supplier->phone=$request->phone;
        $supplier->save();

        return response()->json([
            'error' => false,
            'supplier'  => $supplier,
        ], 200);
    }

    public function supplierlist(){
        $supplier = Supplier::get();
        return response()->json(['message'=>'Successfully','supplier'=>$supplier,'status'=>200]);
    }
    public function supplierbyid($id){
        if(Supplier::where('id',$id)->exists()){
            $supplier = Supplier::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'supplier'=>$supplier]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function supplierupdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(),[ 
            'suppliername' => 'required',
            'contactname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postalcode' => 'required',
            'country' => 'required',
            'phone' => 'required'
           
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Supplier:: where('id',$id)->exists()){
                $supplier = Supplier::find($id);
                $supplier->suppliername=$request->suppliername;
                $supplier->contactname=$request->contactname;
                $supplier->address=$request->address;
                $supplier->city=$request->city;
                $supplier->postalcode=$request->postalcode;
                $supplier->country=$request->country;
                $supplier->phone=$request->phone;
                $supplier->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $supplier,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200); 
            }
        }

    }
    public function supplierdelete($id){

        if(Supplier::where('id',$id)->exists()){
                $supplier = Supplier::find($id);
                $supplier->delete();
                return response()->json(['message'=>'Data deleted successfully','status'=>200]);
            } else {
                return response()->json(['message'=>'Data not found','status'=>404]);
            }
        
        
    }
}
