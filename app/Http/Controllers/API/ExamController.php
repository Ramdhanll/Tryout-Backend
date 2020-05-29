<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Answer;
use App\Question;
use App\Enroll_exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function set_answer(Request $request) {
        

        $answer = DB::table('answers')->where([
            ['user_id','=',$request->user_id],
            ['question_id','=', $request->question_id]
        ]);

        
        if (count($answer->get()) > 0) {
            $request->validate([
                'user_id'               =>  'required|exists:users,id',
                'exam_id'               =>  'required|exists:exams,id',
                'question_id'           =>  'required|exists:questions,id',
                'user_answer_option'    =>  'required'
            ]);

            $question = Question::findOrFail($request->question_id);
            $mark = $this->check_answer($question->answer_option, $request->user_answer_option);
            $request->request->add(['mark' => $mark]);            

            $answer->update($request->all());
            
            return response()->json('successfully', 200);
        } else {
            $request->validate([
                'user_id'               =>  'required|exists:users,id',
                'exam_id'               =>  'required|exists:exams,id',
                'question_id'           =>  'required|exists:questions,id',
                'user_answer_option'    =>  'required'
            ]);

            $question = Question::findOrFail($request->question_id);
            $mark = $this->check_answer($question->answer_option, $request->user_answer_option);
            $request->request->add(['mark' => $mark]);
            
            Answer::create($request->all());
            
            return response()->json('successfully', 200);
        }

        return $answer;

        
    }

    public function check_answer($answer_right, $user_answer) {
        if ($answer_right ==$user_answer) {
            $mark = 1;
        } else {
            $mark = 0;
        }
        return $mark;
    }

    public function get_result($user_id, $exam_id) {
        $total_question = Exam::findOrFail($exam_id)->get('total_question')->first();
        $answer_right = Answer::where('user_id', $user_id)
                                ->where('exam_id', $exam_id)
                                ->sum('mark');
        // (answer_right / total_question) * 100
        $result = ((int) $answer_right /  $total_question->total_question) * 100;
        return response()->json([
            'result'    =>  $result
        ], 200);
    }
}
