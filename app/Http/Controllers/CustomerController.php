<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Customer;

class CustomerController extends Controller
{
    public function customeradd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'customername'=> 'required',
            'contactname' => 'required',
            'address'=> 'required',
            'city' => 'required',
            'country'=> 'required'


        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $customer = new Customer;
        $customer->customername = $request->customername;
        $customer->contactname = $request->contactname;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->postalcode = $request->postalcode;
        $customer->country = $request->country;
        $customer->save();

        return response()->json([
            'error' => false,
            'customer'  => $customer,
        ], 200);
    }

    public function customerlist(){
        $customer = Customer::get();
        return response()->json(['message'=>'Successfully','customer'=>$customer,'status'=>200]);
    }
    public function customerbyid($id){
        if(Customer::where('id',$id)->exists()){
            $customer = Customer::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'customer'=>$customer]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function customerupdate(Request $request, $id){

        $validation = Validator::make($request->all(),[ 
            'customername'=> 'required',
            'contactname' => 'required',
            'address'=> 'required',
            'city' => 'required',
            'country'=> 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Customer:: where('id',$id)->exists()){
                $customer = Customer::find($id);
                $customer->customername = $request->customername;
                $customer->contactname = $request->contactname;
                $customer->address = $request->address;
                $customer->city = $request->city;
                $customer->postalcode = $request->postalcode;
                $customer->country = $request->country;
                $customer->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $customer,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);            }

        }

    }

    
    public function customerdelete($id){

        if(Customer::where('id',$id)->exists()){
            $customer = Customer::find($id);
            $customer->delete();
            return response()->json(['message'=>'Data deleted successfully','status'=>200]);
        } else {
            return response()->json(['message'=>'Data not found','status'=>404]);
        }
    
    
    }
    

}
