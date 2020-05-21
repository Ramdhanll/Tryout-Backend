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
                  <div class="card-body section-exam d-flex">
                      <h1 class="box-title">DAFTAR UJIAN LIST</h1>
                      <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#addExam">Tambah ujian</button>
                  </div>
                  <div class="card-body--">
                      <div class="table-stats order-table ov-h">
                          <table class="table ">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Judul</th>
                                      <th>Waktu Pelaksana</th>
                                      <th>Durasi</th>
                                      <th>Total Pertanyaan</th>
                                      <th>Total Pendaftar</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($exams as $exam)
                                <tr>
                                  <td>{{ $loop->index + 1 }}</td>
                                  <td>{{ $exam->title }}</td>
                                  <td>{{ $exam->date_time }}</td>
                                  <td>{{ $exam->duration }}</td>
                                  <td>{{ $exam->total_question }}</td>
                                  <td>{{ count($exam->enroll_exam) }}</td>
                                  <td>
                                    {{-- <select name="" id="" class="form-control">
                                      <option value=""><span class="badge badge-complete bg-warning">Active</span></option>
                                      <option value=""><span class="badge badge-warning">Pending</span></option>
                                      <option value=""><span class="badge badge-complete">Completed</span></option>
                                    </select> --}}
                                      <span class="badge badge-complete">{{ $exam->status }}</span>
                                  </td>
                                  <td><span class="badge badge-complete">Change Status</span></td>
                              </tr>
                                @empty
                                    
                                @endforelse
                                  
                              </tbody>
                          </table>
                      </div> <!-- /.table-stats -->
                  </div>
              </div> <!-- /.card -->
          </div>
      </div>
  </div>
  <!-- /.orders -->
</div>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="addExam" tabindex="-1" role="dialog" aria-labelledby="addExamLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addExamLabel">Tambah Data Ujian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('exam.store')}}" method="post">
          @csrf
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text"
                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" aria-describedby="helpId" placeholder="Masukan judul ujian">
                @error('title')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
              <label for="date_time">Waktu Pelaksanaan</label>
              <input type="text" id="picker" class="form-control" name="date_time">
              @error('date_time')
                <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <div class="form-group">
                <label for="duration">Durasi</label>
                <select class="form-control" name="duration" id="">
                  <option value="30">30 Menit</option>
                  <option value="60">60 Menit</option>
                  <option value="90">90 Menit</option>
                  <option value="120">120 Menit</option>
                </select>
              </div>
              @error('duration')
                <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="total_question">Total Pertanyaan</label>
              <input type="number"
                class="form-control @error('total_question') is-invalid @enderror" value="{{ old('total_question') }}" name="total_question" id="total_question" aria-describedby="helpId">
                @error('total_question')
                  <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
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
        // value       : Date.now().toString(),

    })
  </script>
@endpush