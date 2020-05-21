@extends('layouts.default')

@section('content')

<!-- Content -->
<div class="content">
  <!-- Orders -->
  <div class="orders">
    <div class="row">
        <div class="col-md-7 mr-auto ml-auto">
            <div class="card">
                <div class="card-body section-pp">
                  @foreach ($student as $item)
                    <img src="{{ url('images/user/'. $item->detail_student->photo)}}" class="img-user" alt="">
                </div>
                <div class="card-body--">
                    <table class="table table-striped table-inverse">
                      <tr>
                        <th>NISN</th>
                        <td>{{ $item->detail_student->nisn }}</td>
                      </tr>
                      <tr>
                        <th>Nama</th>
                        <td>{{ $item->name }}</td>
                      </tr>
                      <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $item->detail_student->gender }}</td>
                      </tr>
                      <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $item->detail_student->date_of_birth }}</td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <td>{{ $item->detail_student->address }}</td>
                      </tr>
                      <tr>
                        <th>Program Keahlian</th>
                        <td>{{ $item->detail_student->expertise_program }}</td>
                      </tr>
                      <tr>
                        <th>Alamat Email</th>
                        <td>{{ $item->email }}</td>
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->
      </div>
  </div>
<!-- /.orders -->
</div>
<!-- /.content -->
@endsection
