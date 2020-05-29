<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Enroll_exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_exam()
    {
        $data = Exam::withCount(['enroll_exam','question'])->get();
        
        return response()->json($data, 200);
    }

    public function set_exam(Request $request) {
        $data = $request->all();
        $data['status'] = 'pending';
        Exam::create($data);

        return response()->json('successfully', 200);
    }

    public function update_exam(Request $request, $id) {
        $data = $request->all();
        $item = Exam::findOrFail($id);
        $item->update($data);

        return response()->json($item, 200);
    }

    public function delete_exam(Request $request, $id) {
        Exam::destroy($id);

        return response()->json('successfully', 200);
    }

    public function enroll_exam(Request $request) {

        $request->validate([
            'user_id'   =>  'required|exists:users,id',
            'exam_id'   =>  'required|exists:exams,id'
        ]);
        $request->request->add(['attendance_status' => 'pending']);

        Enroll_exam::create($request->all());

        return response()->json('successfully', 200);


    }
}
