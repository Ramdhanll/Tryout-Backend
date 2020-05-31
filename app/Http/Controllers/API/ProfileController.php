<?php

namespace App\Http\Controllers\API;

use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function set_student(StudentRequest $request) {
        $student = Student::findOrFail($request->data['student_id']);
        $pathImage = public_path('images/user') . substr($student->photo, 34);
       if ($request->data['photo']) {
           $namePhoto = time().'.' . explode('/', explode(':', substr($request->data['photo'], 0, strpos($request->data['photo'], ';')))[1])[1];
           \Image::make($request->data['photo'])->save(public_path('images/user/').$namePhoto);
            $student->nisn = $request->data['nisn'];
            $student->gender = $request->data['gender'];
            $student->date_of_birth = $request->data['date_of_birth'];
            $student->address = $request->data['address'];
            $student->expertise_program = $request->data['expertise_program'];
            $student->photo = "http://api.tryout.test/images/user/" . $namePhoto;

            // return $oldImage;
            // unlink($oldImage);
            File::delete($pathImage);
            // if (file_exists($oldImage)) {
            //     @unlink($oldImage);
            // }

            // $this->removeImage($request->data['student_id']);


       } else {
            $student->nisn = $request->data['nisn'];
            $student->gender = $request->data['gender'];
            $student->date_of_birth = $request->data['date_of_birth'];
            $student->address = $request->data['address'];
            $student->expertise_program = $request->data['expertise_program'];
       }

       $user = User::findOrFail($request->data['user_id']);
        $user->name = $request->data['name'];
        $user->save();

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

    public function removeImage($id) {
        $data = Student::findOrFail($id);
        $oldImage = public_path('images/user/'. $data->photo);

        if (file_exists($oldImage)) {
            @unlink($oldImage);
        }
    }
}
