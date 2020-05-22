<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Enroll_exam;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;

class ExamController extends Controller
{
    public function index() {
        $data = Exam::with(['enroll_exam'])->get();

        // dd($data);
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
