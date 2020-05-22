<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Option;
use App\Question;
use App\Enroll_exam;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;

class ExamController extends Controller
{
    public function index() {
        $data = Exam::with(['enroll_exam','question'])->get();
        return view('pages.exam.index', [
            'exams' => $data
        ]);
    }

    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        $data = $request->all();
        $data['status'] = 'pending';
        Exam::create($data);

        return redirect(route('exam.index'))->with(['succes' => 'Data berhasil ditambahkan!']);

    }

    public function showQuestion($id) {
        $exam = Exam::findOrFail($id);
        $questions = Question::with('exam')->where('exam_id',$id)->orderBy('id','desc')->paginate(5);
        $title_exam = Exam::select('title','total_question')->where('id',$id)->first();
        return view('pages.exam.showQuestion', [
            'questions' => $questions,
            'total_question'    => $title_exam->total_question,
            'title_exam'    =>  $title_exam->title,
            'exam' => $exam
        ]);
    }

    public function showOption($id) {
        $options = Option::where('question_id',$id)->orderBy('option_number','asc')->get();
        $question = Question::findOrFail($options[0]->question_id);
        return view('pages.exam.showOption', [
            'options' => $options,
            'question' => $question
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exams = Exam::all();
        $questions = Question::with('exam')->where('id',$id)->orderBy('id','desc')->paginate(5);
        // dd($questions);

        return view('pages.exam.show', [
            'exams' => $exams,
            'questions' => $questions,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Exam::findOrFail($id);
        return view('pages.exam.edit',[
            'exam'  =>  $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, $id)
    {
        $data = $request->all();
        $item = Exam::findOrFail($id);
        $item->update($data);

        return redirect(route('exam.index'))->with(['succes' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::destroy($id);
        return redirect( route('exam.index'))->with(['success' => 'Data berhasil dihapus']);
    }
}
