<?php

namespace App\Http\Controllers\API;

use App\Exam;
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
}
