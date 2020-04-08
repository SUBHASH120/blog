<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class ApiController extends Controller
{
    public function getAllStudent(){

        $student = Student::get();
        return response()->json(['message'=>'Get All students ','data'=>$student]);
    }
    public function createStudent(Request $request ){

        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();
        return response()->json(['message'=>'Added student successfully'],201);

    }
    public function getStudent($id){

        if(Student::where('id',$id)->exists()){
            $student= Student::where('id',$id)->get();
            return response()->json(['message'=>'Get student ','data'=>$student]);
        } else {
            return response()->json(['message'=>'Student not found']);
        }
        

    }
    public function updateStudent(Request $request, $id){


        if(Student::where('id',$id)->exists()){
            $student = Student::find($id);
            $student->name=is_null($request->name)?$student->name:$request->name;
            $student->course=is_null($request->course)?$student->course:$request->course;
            $student->save();
            return response()->json(['message'=>'Student updated successfully  ']);
        } else {
            return response()->json(['message'=>'Student not found']);

        }
        

    }
    public function deleteStudent($id){

        if(Student::where('id',$id)->exists()){
            $student=Student::find($id);
            $student->delete();
            return response()->json(['message'=>'Deleted student ']);
        } else {
            return response()->json(['message'=>'Student not found']);
        }
        

    }
}
