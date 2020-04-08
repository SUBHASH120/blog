<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    
    public function categoryadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'categoryname' => 'required',
            'description' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $category = new Category;
        $category->categoryname = $request->categoryname;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'error' => false,
            'category'  => $category,
        ], 200);
    }

    public function categorylist(){
        $category = Category::get();
        return response()->json(['message'=>'Successfully','category'=>$category,'status'=>200]);
    }
    public function categorybyid($id){
        if(Category::where('id',$id)->exists()){
            $category = Category::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'category'=>$category]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function categoryupdate(Request $request, $id){

        $validation = Validator::make($request->all(),[ 
            'categoryname' => 'required',
            'description' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Category:: where('id',$id)->exists()){
                $category = Category::find($id);
                $category->categoryname = $request->categoryname;
                $category->description = $request->description;
                $category->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $category,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);            }

        }

    }

    
    public function categorydelete($id){

        if(Category::where('id',$id)->exists()){
            $category = Category::find($id);
            $category->delete();
            return response()->json(['message'=>'Data deleted successfully','status'=>200]);
        } else {
            return response()->json(['message'=>'Data not found','status'=>404]);
        }
    
    
    }
}
