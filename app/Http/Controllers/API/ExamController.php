<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Answer;
use App\User;
use App\Question;
use App\Enroll_exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_exam()
    {
        $car = \Carbon\Carbon::now()->toDateTimeString(); 
        // return $car;
        // return $date;
        $data = Exam::withCount(['enroll_exam','question'])
                    ->where('date_time','>',$car)
                    ->where('status', '=','pending')
                    ->get();
        
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
            'exam_id'   =>  'required|exists:exams,id'
        ]);
        // $request->request->add(['attendance_status' => 'pending']);
        $request->merge(['attendance_status' => 'pending']);
        $request->merge(['user_id' => Auth::id()]);

        Enroll_exam::create($request->all());

        return response()->json('successfully', 200);
    }

    public function enroll_exam_registered(Request $request) {
        $data = Enroll_exam::where('user_id', Auth::id())->get(['exam_id']);

        return response()->json($data, 200);
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

    public function get_result(Request $request) {
        $exam_registered = Enroll_exam::where('user_id', Auth::id())
                            ->with('exam')
                            ->get();

        foreach ($exam_registered as $item) {
            $total_question = $item->exam->total_question;
            $answer_right = Answer::where('user_id', $item->user_id)
                            ->where('exam_id', $item->exam_id)
                            ->sum('mark');

            $result = ((int) $answer_right /  $total_question) * 100;

            $item->exam->result = $result;
        }


        return response()->json($exam_registered, 200);
    }
}
