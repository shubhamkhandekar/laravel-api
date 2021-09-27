<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{student,countries};
use Validator;
class StudentController extends Controller
{
    
    public function index(Request $request)
    {
        
    }

    public function create(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'phone_number'=>'required|unique:students',
            'email'=>'required|unique:students',
            'country_code'=>'required'
          ]);

        $country = countries::where('country_code', $request->country_code)->value('country');
       // $student= student::where('email', $request->email)->first();
       if($validator->fails()){
        return response()->json(['success'=>false,'errors'=>$validator->errors()],400);
       }else{
            $res= student::create([
                'name'=>$request->name,
                'phone_number'=>$request->phone_number,
                'email'=>$request->email,
                'country_code'=>$request->country_code,
                'country'=>$country
             ]);
             return response()->json(['success'=>true,'data'=>$res],200);
         }
       
    }

    public function search($name)
    {
        return student::where('name', 'like', '%'.$name.'%')->get();
    }

    public function searchwithpaginate($name)
    {
        return student::where('name', 'like', '%'.$name.'%')->paginate(1);
    }
}
