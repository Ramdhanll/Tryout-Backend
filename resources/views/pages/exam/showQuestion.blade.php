@extends('layouts.default')

@push('after-style')
  <link rel="stylesheet" href="{{ asset('js/jquery.datetimepicker.min.css')}}">
@endpush

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
          <div class="col-xl-12">
              <div class="card">
                  <div class="card-body section-question d-flex">
                    <h1 class="box-title">DAFTAR PERTANYAAN UJIAN {{ strtoupper($title_exam) }}</h1>
                    <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#addquestion">Tambah Pertanyaan</button>
                  </div>
                  <div class="card-body--">
                      <div class="table-stats order-table ov-h">
                          <table class="table ">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Pertanyaan</th>
                                      <th>Jawaban Benar</th>
                                      <th class="text-left">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($questions as $question)
                                <tr>
                                  <td>{{ $questions->currentPage() == '1' ? $loop->index + 1 : $questions->perPage() + 1 }}</td>
                                  <td>{{ $question->question_title }}</td>
                                  <td>
                                    @if ($question->answer_option === 1)
                                        A
                                    @elseif ($question->answer_option === 2)
                                        B
                                    @elseif ($question->answer_option === 3)
                                        C
                                    @elseif ($question->answer_option === 4)
                                        D
                                    @endif
                                  </td>
                                  <td class="text-left">
                                    <a href="{{ route('exam.question.option', $question->id )}}" class="btn btn-success py-1 px-2 mr-1"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('question.edit', $question->id )}}" class="btn btn-warning py-1 px-2 mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                      <form action="{{ route('question.destroy', $question->id )}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger py-1 px-2"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                      </form>
                                  </td>
                                </tr>
                                @empty
                                @endforelse
                                <tr>
                                  <td colspan="5">SOAL {{ $questions->total() }} / {{ $total_question}}</td>
                                </tr>
                              </tbody>
                          </table>
                      </div> <!-- /.table-stats -->
                  </div>
              </div> <!-- /.card -->
              {{ $questions->links() }}
          </div>
      </div>
  </div>
  <!-- /.orders -->
</div>
<!-- /.content -->




<!-- Modal -->
<div class="modal fade" id="addquestion" tabindex="-1" role="dialog" aria-labelledby="addquestionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addquestionLabel">Tambah Data Ujian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('question.store')}}" method="post">
          @csrf
          <div class="form-group">
            <div class="form-group">
              <label for="exam_id">Judul Ujian</label>
              <select class="form-control @error('exam_id') is-invalid @enderror" name="exam_id" id="">
                  <option value="{{ $exam->id }}">{{ $exam->title }}</option>
              </select>
            </div>
            @error('exam_id')
              <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
            @enderror
          </div>
            <div class="form-group">
              <label for="question_title">Pertanyaan</label>
                <label for="question_title"></label>
                <textarea class="form-control  @error('question_title') is-invalid @enderror" name="question_title" id="question_title" rows="3">{{ old('question_title') }}</textarea>
              
                @error('question_title')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
              <div class="form-group">
                <label for="answer_option">Jawaban Benar</label>
                <select class="form-control @error('answer_option') is-invalid @enderror" name="answer_option" id="">
                  <option value="1">A</option>
                  <option value="2">B</option>
                  <option value="3">C</option>
                  <option value="4">D</option>
                </select>
              </div>
              @error('answer_option')
                <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="option[]">Opsi A</label>
              <input type="text"
                class="form-control @error('option[]') is-invalid @enderror" value="{{ old('option[]') }}" name="option[]" id="option[]" aria-describedby="helpId">
                @error('option[]')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
              <label for="option[]">Opsi B</label>
              <input type="text"
                class="form-control @error('option[]') is-invalid @enderror" value="{{ old('option[]') }}" name="option[]" id="option[]" aria-describedby="helpId">
                @error('option[]')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
              <label for="option[]">Opsi C</label>
              <input type="text"
                class="form-control @error('option[]') is-invalid @enderror" value="{{ old('option[]') }}" name="option[]" id="option[]" aria-describedby="helpId">
                @error('option[]')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
              <label for="option[]">Opsi D</label>
              <input type="text"
                class="form-control @error('option[]') is-invalid @enderror" value="{{ old('option[]') }}" name="option[]" id="option[]" aria-describedby="helpId">
                @error('option[]')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
          </div>
          
          <div class="modal-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success py-1 px-2 mr-2">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection

@push('after-script')
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js')}}"></script>
  <script>
    $('#picker').datetimepicker({
        timepicker  : true,
        datepicker  : true,
        format      : 'd-m-Y H:00:00',
        value       : '',

    })
  </script>
@endpush