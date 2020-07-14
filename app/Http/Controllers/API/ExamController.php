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
use Illuminate\Database\Eloquent\Builder;

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

        $enroll = Enroll_exam::create($request->all());

        return response()->json($enroll, 200);
    }

    public function enroll_exam_registered(Request $request) {
        $data = Enroll_exam::where('user_id', Auth::id())->get(['exam_id']);

        return response()->json($data, 200);
    }

    public function set_answer(Request $request) {
        // return $request->all();
        $answers = $request->user_answers;
        $userID = Auth::id();
        $data = array();
        for($i=0; $i < count($answers); $i++) {
            $question = Question::findOrFail($answers[$i][0]);
            $mark = $this->check_answer($question->answer_option, $answers[$i][1]);
            $data['user_id'] = $userID;
            $data['exam_id'] = $request->exam_id;
            $data['question_id'] = $answers[$i][0];
            $data['user_answer_option'] = $answers[$i][1];
            $data['mark']  = $mark;

            Answer::create($data);
            $data = [];
        }
        Enroll_exam::where('exam_id', $request->exam_id)
                ->update(['attendance_status' => "completed"]);
       
        return response()->json('successfully', 200);
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

    public function get_question(Request $request) {

        // return response()->json($request->all(), 200);   

        // $data = Enroll_exam::with(['exam.question'])
        //     ->where(exam.id,'=', 1)
        //     ->get();
        $slug = $request->slug;
        $data = Enroll_exam::with('exam.question.option')
                ->whereHas('exam', function (Builder $query) use ($slug) {
                    $query->where('slug','=', $slug);
                    $query->where('status','=', 'started');
                })->get();


        return response()->json($data, 200);
    }

    public function get_detail_exam_result(Request $request, $exam_id) {
        $userID = Auth::id();
        $result = Answer::where('user_id', $userID)
                            ->where('exam_id', $exam_id)
                            ->with('question.option')
                            ->get();

        return  $result;
    }       
}