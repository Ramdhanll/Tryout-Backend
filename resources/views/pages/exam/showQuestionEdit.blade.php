@extends('layouts.default')


@push('after-style')
  <link rel="stylesheet" href="{{ asset('js/jquery.datetimepicker.min.css')}}">
@endpush

@section('content')
<!-- Content -->
<div class="content">
  <!-- Orders -->
  <div class="orders">
    <div class="row">
        <div class="col-md-7 mr-auto ml-auto">
            <div class="card">
                <div class="card-body section-pp">
                  <h3>FORM EDIT QUESTION</h3>
                </div>
                <div class="card-body-- p-3">
                  <form action="{{ route('exam.question.update', $question->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <div class="form-group">
                        <label for="exam_id">Judul Ujian</label>
                        <select class="form-control @error('exam_id') is-invalid @enderror" name="exam_id" id="">
                          @forelse ($exams as $exam)
                            <option {{ $question->exam_id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->title }}</option>
                          @empty
                            <option value="">Ujian Tidak Kosong</option>
                          @endforelse
                        </select>
                      </div>
                      @error('exam_id')
                        <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                      <div class="form-group">
                        <label for="question_title">Pertanyaan</label>
                        <input type="text"
                          class="form-control @error('question_title') is-invalid @enderror" value="{{ $question->question_title }}" name="question_title" id="question_title" aria-describedby="helpId" placeholder="Masukan judul ujian">
                          @error('question_title')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div>
                      
                      <div class="form-group">
                        <div class="form-group">
                          <label for="answer_option">Jawaban Benar</label>
                          <select class="form-control @error('answer_option') is-invalid @enderror" name="answer_option" id="">
                            <option {{ $question->answer_option == '1' ? 'selected' : '' }} value="1">A</option>
                            <option {{ $question->answer_option == '2' ? 'selected' : '' }} value="2">B</option>
                            <option {{ $question->answer_option == '3' ? 'selected' : '' }} value="3">C</option>
                            <option {{ $question->answer_option == '4' ? 'selected' : '' }} value="4">D</option>
                          </select>
                        </div>
                        @error('answer_option')
                          <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                        @enderror
                      </div>

                      @foreach ($question->option as $item)
                      <?php $opsi = ['A','B','C','D'] ?>
                      <div class="form-group">
                        <label for="option[]">Opsi {{ $opsi[$loop->index]}}</label>
                        <input type="hidden" name="option_id[]" value="{{ $item->id }}">
                        <input type="text"
                          class="form-control @error('option[]') is-invalid @enderror" value="{{ $item->option_title }}" name="option[]" id="option[]" aria-describedby="helpId">
                          @error('option[]')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div>
                      @endforeach
                      {{-- <div class="form-group">
                        <label for="option[]">Opsi A</label>
                        <input type="hidden" name="option_id" value="{{}}">
                        <input type="text"
                          class="form-control @error('option[]') is-invalid @enderror" value="{{ $question->option[0]->option_title }}" name="option[]" id="option[]" aria-describedby="helpId">
                          @error('option[]')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div> --}}
                      {{-- <div class="form-group">
                        <label for="option[]">Opsi B</label>
                        <input type="text"
                          class="form-control @error('option[]') is-invalid @enderror" value="{{ $question->option[1]->option_title }}" name="option[]" id="option[]" aria-describedby="helpId">
                          @error('option[]')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="option[]">Opsi C</label>
                        <input type="text"
                          class="form-control @error('option[]') is-invalid @enderror" value="{{ $question->option[2]->option_title }}" name="option[]" id="option[]" aria-describedby="helpId">
                          @error('option[]')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="option[]">Opsi D</label>
                        <input type="text"
                          class="form-control @error('option[]') is-invalid @enderror" value="{{ $question->option[3]->option_title }}" name="option[]" id="option[]" aria-describedby="helpId">
                          @error('option[]')
                            <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                          @enderror
                      </div> --}}
                    </div>
                    <div class="d-flex justify-content-end pb-3 pr-3">
                      <button type="submit" class="btn btn-success py-1 px-2 mr-2">Simpan</button>
                      <a href="{{ route('exam.question', $question->exam_id)}}" class="btn btn-danger py-1 px-2">Kembali</a>
                    </div>
                  </form>
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->
      </div>
  </div>
<!-- /.orders -->
</div>
<!-- /.content -->
@endsection


@push('after-script')
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js')}}"></script>
  <script>
    $('#picker').datetimepicker({
        timepicker  : true,
        datepicker  : true,
        format      : 'd-m-Y H:00:00',
        // value       : Date.now().toString(),

    })
  </script>
@endpush