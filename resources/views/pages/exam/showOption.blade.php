@extends('layouts.default')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
  @endif
<!-- Content -->
<div class="content">
    <!-- Orders -->
    <div class="orders">
      <div class="row">
          <div class="col-xl-8 m-auto">
              <div class="card">
                  <div class="card-body section-option ">
                    <h1 class="box-title">SOAL</h1>
                        <h3>{{ $question->question_title }}</h3>
                        <h5>Jawaban benar :
                          @if ($question->answer_option == 1)
                            A
                          @elseif($question->answer_option == 2)
                            B
                          @elseif($question->answer_option == 3)
                            C
                          @elseif($question->answer_option == 4)
                            D
                          @endif 
                        
                        </h5>
                  </div>
                  <div class="card-body--">
                    <table class="table table-striped table-inverse">
                      <tr>
                        <th>Pilihan A</th>
                        <td>{{ $options[0]->option_title }}</td>
                      </tr>
                      <tr>
                        <th>Pilihan B</th>
                        <td>{{ $options[1]->option_title }}</td>
                      </tr>
                      <tr>
                        <th>Pilihan C</th>
                        <td>{{ $options[2]->option_title }}</td>
                      </tr>
                      <tr>
                        <th>Pilihan D</th>
                        <td>{{ $options[3]->option_title }}</td>
                      </tr>
                    </table>
                    <div class="text-right ml-auto p-2">

                      <a href="{{ route('exam.question', $question->exam_id)}}" class="btn btn-success">Kembali</a>
                    </div>
                  </div>
              </div> <!-- /.card -->
          </div>
      </div>
  </div>
  <!-- /.orders -->
</div>
<!-- /.content -->
@endsection
