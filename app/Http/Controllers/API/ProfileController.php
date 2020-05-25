<?php

namespace App\Http\Controllers\API;

use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function set_student(Request $request, $id) {

        // $request->request->add(['user_id' => $id]); //add request
        $request->validate([
            'nisn'   					=>  'required|numeric',
            'gender'    				=>  'required',
            'date_of_birth' 		    =>  'required',
            'address'   				=>  'required',
            'expertise_program'	        =>  'required',
            'photo'   					=>  'required',
        ]);

        $student = Student::findOrFail($id);

        $student->user_id = $id;
        $student->nisn = $request->nisn;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->address = $request->address;
        $student->expertise_program = $request->expertise_program;
        $student->photo = $request->photo;

        $student->save();
        return response()->json('Successfully', 200);
    }
    
    public function set_teacher(Request $request, $id) {

        $request->validate([
            'nip'       		=>  'required|numeric',
            'gender'    		=>  'required',
            'date_of_birth'     =>  'required',
            'address'  	 		=>  'required',
            'lesson'   			=>  'required',
            'photo'   			=>  'required',
        ]);

        $student = Teacher::findOrFail($id);
        $student->nip = $request->nip;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->address = $request->address;
        $student->lesson = $request->lesson;
        $student->photo = $request->photo;

        $student->save();
        return response()->json('Successfully', 200);
    }
}
