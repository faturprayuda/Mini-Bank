@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Transaksi Customer')

{{-- main title --}}
@section('main title', 'Data Transaksi Customer')

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
                <th>No. Rekening Customer</th>
                <th>No. Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Total Transaksi</th>
                <th>Kegiatan</th>
                <th>Tujuan Transfer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transaksi as $userdata)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $userdata->rekening->user->name }}</td>
                <td>{{ $userdata->rekening->no_rekening }}</td>
                <td>{{ $userdata->no_transaksi }}</td>
                <td>{{ $userdata->date_transaksi}}</td>
                <td>
                  @if ($userdata->status == NULL)
                  -
                  @else
                  {{ $userdata->status }}
                  @endif
                </td>
                <td>{{ $userdata->total_transaksi }}</td>
                <td>{{ $userdata->action }}</td>
                <td>
                  @if ($userdata->tujuan_tf == NULL)
                  -
                  @else
                  {{ $userdata->tujuan_tf }}
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama Customer</th>
                <th>No. Rekening Customer</th>
                <th>No. Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Total Transaksi</th>
                <th>Kegiatan</th>
                <th>Tujuan Transfer</th>
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