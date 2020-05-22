<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Option;
use App\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function index() {
        $exams = Exam::all();
        $questions = Question::with('exam')->orderBy('exam_id','desc')->paginate(5);

        return view('pages.question.index', [
            'exams' => $exams,
            'questions' => $questions,
            
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
    public function store(QuestionRequest $request)
    {
        $data = $request->all();
        $question = Question::create($data);

        for ($i=0; $i < count($request->option); $i++) { 
            $option['question_id'] = $question->id;
            $option['option_number'] = $i + 1;
            $option['option_title'] = $request->option[$i];

            Option::create($option);
        }
        return redirect(route('exam.question', $question->exam_id))->with(['succes' => 'Data berhasil ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exams = Exam::all();
        $data = Question::findOrFail($id);
        return view('pages.question.edit',[
            'exams'      => $exams,
            'question'  =>  $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $data = $request->all();
        $item = Question::findOrFail($id);
        $item->update($data);

        return redirect(route('question.index'))->with(['succes' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Question::findOrFail($id);
        Question::destroy($id);
        return redirect( route('exam.question',  $data->exam_id))->with(['success' => 'Data berhasil dihapus']);
    }
}

