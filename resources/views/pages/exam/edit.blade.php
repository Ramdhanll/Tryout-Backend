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
                  <h3>FORM EDIT EXAM</h3>
                </div>
                <div class="card-body-- p-3">
                  <form action="{{ route('exam.update', $exam->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="title">Judul</label>
                      <input type="text"
                        class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="helpId" value="{{ $exam->title }}">
                        @error('title')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                    <div class="form-group">
                      <label for="date_time">Waktu Pelaksana</label>
                      <input type="text"
                        class="form-control @error('date_time') is-invalid @enderror" name="date_time" id="picker" aria-describedby="helpId" value="{{ $exam->date_time }}">
                        @error('date_time')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label for="duration">Durasi</label>
                        <select class="form-control" name="duration" id="">
                          <option {{ $exam->duration == '30' ? 'selected' : '' }} value="30">30 Menit</option>
                          <option {{ $exam->duration == '60' ? 'selected' : '' }} value="60">60 Menit</option>
                          <option {{ $exam->duration == '90' ? 'selected' : '' }} value="90">90 Menit</option>
                          <option {{ $exam->duration == '120' ? 'selected' : '' }} value="120">120 Menit</option>
                        </select>
                      </div>
                      @error('duration')
                        <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="total_question">Total Pertanyaan</label>
                      <input type="number"
                        class="form-control @error('total_question') is-invalid @enderror" value="{{ $exam->total_question }}" name="total_question" id="total_question" aria-describedby="helpId">
                        @error('total_question')
                          <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="total_question">Status</label>
                          <select class="form-control @error('status') is-invalid @enderror" name="status" required autocomplete="status">
                              <option {{ $exam->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                              <option {{ $exam->status == 'started' ? 'selected' : '' }} value="started">Started</option>
                              <option {{ $exam->status == 'completed' ? 'selected' : '' }} value="completed">Completed</option>
                          </select>

                          @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-success py-1 px-2 mr-2">Simpan</button>
                      <a href="{{ route('exam.index')}}" class="btn btn-danger py-1 px-2">Kembali</a>
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