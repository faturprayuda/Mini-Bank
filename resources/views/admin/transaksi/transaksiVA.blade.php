@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Transaksi VA Customer')

{{-- main title --}}
@section('main title', 'Data Transaksi VA Customer')

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-9">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Customer</th>
                <th>No. Virtual Account</th>
                <th>Total Transaksi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data_va as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_user }}</td>
                <td>{{ $data->no_va }}</td>
                <td>{{ $data->total_pembayaran }}</td>
                <td>{{ $data->status}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama Customer</th>
                <th>No. Virtual Account</th>
                <th>Total Transaksi</th>
                <th>Status</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- ./col -->
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
  @endsection