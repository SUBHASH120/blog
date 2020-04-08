<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $validation = Validator::make($request->all(),[ 
            'email' => 'required|email',
            'password'=>'required'
            
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            $matchThese = ['email' => $request->email, 'password' => $request->password];

            if(User:: where($matchThese)->exists()){
                $user = User::get();
                return response()->json([
                    'error' => false,
                    'messages'  => $user,
                ], 200);
            }
            else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);

            }
        }


    }
    public function register(Request $request){
        $validation = Validator::make($request->all(),[ 
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $user = new User;
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->save();
     
            return response()->json([
                'error' => false,
                'user'  => $user,
            ], 200);
        }

       

    }
    public function listing(){

        $user = User::get();
        return response()->json(['message'=>'Successfully','users'=>$user,'status'=>200]);

    }
    public function update(Request $request, $id){

        $validation = Validator::make($request->all(),[ 
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(User:: where('id',$id)->exists()){
                $user= User::find($id);
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $user,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);            }

        }



        
    }

    public function delete($id){

        if(User::where('id',$id)->exists()){
            $user = User::find($id);
            $user->delete();
            return response()->json(['message'=>'Data deleted successfully','status'=>200]);
        } else {
            return response()->json(['message'=>'Data not found','status'=>404]);
        }


    }
    public function listingbyid($id){
        if(User::where('id',$id)->exists()){
            $user = User::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'users'=>$user]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
}
