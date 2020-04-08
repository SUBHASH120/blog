<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Employee;

class EmployeeController extends Controller
{
  
    public function employeeadd(Request $request){
        $validation = Validator::make($request->all(),[
            
            'lastname' => 'required',
            'firstname' => 'required',
            'birthdate' => 'required',
            'photo' => 'required',
            'notes' => 'required'


        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

        }
        $employee = new Employee;
        $employee->lastname=$request->lastname;
        $employee->firstname=$request->firstname;
        $employee->birthdate=$request->birthdate;
        $employee->photo=$request->photo;
        $employee->notes=$request->notes;
        $employee->save();

        return response()->json([
            'error' => false,
            'employee'  => $employee,
        ], 200);
    }

    public function employeelist(){
        $employee = Employee::get();
        return response()->json(['message'=>'Successfully','employee'=>$employee,'status'=>200]);
    }
    public function employeebyid($id){
        if(Employee::where('id',$id)->exists()){
            $employee = Employee::where('id',$id)->get();
            return response()->json(['message'=>'Get data by id','status'=>200,'employee'=>$employee]);

        } else {
            return response()->json(['message'=>'Data not found']);
        }
    }
    public function employeeupdate(Request $request, $id){

        $validation = Validator::make($request->all(),[ 
            'lastname' => 'required',
            'firstname' => 'required',
            'birthdate' => 'required',
            'photo' => 'required',
            'notes' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else {
            if(Employee:: where('id',$id)->exists()){
                $employee = Employee::find($id);
                $employee->lastname=$request->lastname;
                $employee->firstname=$request->firstname;
                $employee->birthdate=$request->birthdate;
                $employee->photo=$request->photo;
                $employee->notes=$request->notes;
                $employee->save();
                return response()->json([
                    'error' => false,
                    'messages'  => $employee,
                ], 200);
            }else {
                return response()->json([
                    'error' => true,
                    'messages'  => $validation->errors(),
                ], 200);            }

        }

    }

    
    public function employeedelete($id){

        if(Employee::where('id',$id)->exists()){
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json(['message'=>'Data deleted successfully','status'=>200]);
        } else {
            return response()->json(['message'=>'Data not found','status'=>404]);
        }
    
    
    }
}
