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
                  @foreach ($teacher as $item)
                    <img src="{{ url('images/user/'. $item->detail_teacher->photo)}}" class="img-user" alt="">
                </div>
                <div class="card-body--">
                    <table class="table table-striped table-inverse">
                      <tr>
                        <th>NIP</th>
                        <td>{{ $item->detail_teacher->nip }}</td>
                      </tr>
                      <tr>
                        <th>Nama</th>
                        <td>{{ $item->name }}</td>
                      </tr>
                      <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $item->detail_teacher->gender }}</td>
                      </tr>
                      <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $item->detail_teacher->date_of_birth }}</td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <td>{{ $item->detail_teacher->address }}</td>
                      </tr>
                      <tr>
                        <th>Pelajaran</th>
                        <td>{{ $item->detail_teacher->lesson }}</td>
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
