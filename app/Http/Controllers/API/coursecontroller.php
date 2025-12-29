<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\courseresource;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class coursecontroller extends Controller
{
    public function save(Request $request){
        $validate=Validator::make($request->all(),[
            "course_name" => "required|max:255",
    "course_price" => "required|numeric|min:100",
    "course_description" => "required|max:255",
        ]);
        if($validate->fails()){
            return response()->json([
                "success"=>"false",
                "errors"=>$validate->errors(),
            ]);

        }
        $course= new Course();
        $course->name=$request->course_name;
        $course->price=$request->course_price;
        $course->description=$request->course_description;
        $course->save();

        return response()->json([
            "success"=>"true",
            "message"=>"course created sucessfully"
        ]);
    }
    public function show(){
        $course= course::all();
        return courseresource::collection($course);
    }
     public function update(Request $request,$id){
        $validate=Validator::make($request->all(),[
            "course_name" => "required|max:255",
    "course_price" => "required|numeric|min:100",
    "course_description" => "required|max:255",
        ]);
        if($validate->fails()){
            return response()->json([
                "success"=>"false",
                "errors"=>$validate->errors(),
            ]);

        }

        $course= Course::find($id);
        if(!$course){
               return response()->json([
                 "success"=>"false",
                 "message"=>"invalid url",
               ]);
            }

        $course->name=$request->course_name;
        $course->price=$request->course_price;
        $course->description=$request->course_description;
        $course->save();

        return response()->json([
            "success"=>"true",
            "course"=>$course,
            "message"=>"course updated sucessfully"
        ]);
    }
    public function delete($id){
        $course=course::find($id);
        if(!$course){
               return response()->json([
                 "success"=>"false",
                 "message"=>"invalid url",
               ]);
            }
            $course->delete();
            return response()->json([
            "success"=>"true",
            "message"=>"course deleted sucessfully"
        ]);
    }
}
