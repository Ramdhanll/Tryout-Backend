@extends('layouts.default')

@section('content')
<!-- Content -->
<div class="content">
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
  @endif
  <!-- Orders -->
  <div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title font-weight-bold">SISWA LIST </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">No</th>
                                    <th class="avatar">NISN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Program Keahlian</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($students as $student)
                                <tr>
                                  <td>{{ $loop->index + 1}}</td>
                                  <td>{{ $student->detail_student->nisn }}</td>
                                  <td>{{ $student->name }}</td>
                                  <td>{{ $student->detail_student->gender }}</td>
                                  <td>{{ $student->detail_student->expertise_program }}</td>
                                  <td class="text-left">
                                      <a href="{{ route('student.show', $student->id )}}" class="btn btn-success py-1 px-2 mr-1"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                      <form action="{{ route('student.destroy', $student->id )}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger py-1 px-2"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                      </form>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td colspan="6" class="text-center">Data Kosong</td>
                                </tr>
                              @endforelse
                                
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->
      </div>
  </div>
<!-- /.orders -->
</div>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-labelledby="viewDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDetailLabel">Detail Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>a</th>
              <th>a</th>
              <th>a</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td scope="row"></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
