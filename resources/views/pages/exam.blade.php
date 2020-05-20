@extends('layouts.default')

@section('content')
<!-- Content -->
<div class="content">
    <!-- Orders -->
    <div class="orders">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                  <div class="card-body head-title">
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
                                  <tr>
                                      <td>1</td>
                                      <td>Matematika</td>
                                      <td>17-Juni-2020</td>
                                      <td>30 Menit</td>
                                      <td>30 Pertanyaan</td>
                                      <td>10 Peserta</td>
                                      <td>
                                        {{-- <select name="" id="" class="form-control">
                                          <option value=""><span class="badge badge-complete bg-warning">Active</span></option>
                                          <option value=""><span class="badge badge-warning">Pending</span></option>
                                          <option value=""><span class="badge badge-complete">Completed</span></option>
                                        </select> --}}
                                          <span class="badge badge-complete">Complete</span>
                                      </td>
                                      <td><span class="badge badge-complete">Change Status</span></td>
                                  </tr>
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
        <form action="" method="post">
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
              <input type="datetime-local"
                class="form-control" name="date_time" id="date_time" aria-describedby="helpId">
              @error('title')
                <small id="helpId" class="form-text text-danger invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
