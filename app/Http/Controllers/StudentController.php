<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use Illuminate\Support\Facades\Validator;
// use Input;


class StudentController extends Controller
{
    public function index() {
        $student = Student::all();

        $data = [
            'status'=>200,
            'student'=> $student,
        ];
        return response()->json($data, 200);
    }

    public function upload(Request $request) {

        // $user = Student::where('email', '=', Input::get('email'));
        
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if($validator->fails()) {

            $data = [
                'status'=>445,
                'student'=>$validator->messages()
            ];

            return response()->json($data, 445);
        } else {
            // if($validator){
            //     //
            // }
            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            $student->save();

            $data = [
                'status'=>200,
                'message'=>'Data Uploaded successfully',
            ];

            return response()->json($data, 200);
        }
    }

    public function edit(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if($validator->fails()) {

            $data = [
                'status'=>445,
                'student'=>$validator->messages()
            ];

            return response()->json($data, 445);
        } else {
            // if($validator){
            //     //
            // }
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            $student->save();

            $data = [
                'status'=>200,
                'message'=>'Data Updated successfully',
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id) {
        $student = Student::find($id);
        $student->delete();

        $data = [
            'status'=>200,
            'message'=> 'Data deleted successfully'
        ];
        return response()->json($data, 200);
    }
}
