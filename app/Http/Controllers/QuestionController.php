<?php

namespace App\Http\Controllers;

use App\Exam;
use App\question;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function index() {
        $exams = Exam::all();
        $questions = Question::with('exam')->get();
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
        Question::create($data);
        return redirect(route('question.index'))->with(['succes' => 'Data berhasil ditambahkan!']);

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
        Question::destroy($id);
        return redirect( route('question.index'))->with(['success' => 'Data berhasil dihapus']);
    }
}

