@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Rekening Customer')

{{-- main title --}}
@section('main title', 'Data Rekening Customer')

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
            <div class="col-3">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-rek">
                <i class="fas fa-plus"></i> Buat Rekening Customer
              </button>
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
                <th>No. Rekening</th>
                <th>PIN</th>
                <th>Saldo</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rekening as $rk)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rk->user->name }}</td>
                <td>{{ $rk->no_rekening }}</td>
                <td>{{ $rk->pin }}</td>
                <td>Rp. {{ $rk->saldo }}</td>
                <td><a href="customer/edit/{{ $rk->id }}" class="badge badge-success" style="color: white">Ubah</a> |
                  <a href="customer/hapus/{{ $rk->id }}" class="badge badge-danger">Hapus</a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama Customer</th>
                <th>No. Rekening</th>
                <th>PIN</th>
                <th>Saldo</th>
                <th>Aksi</th>
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

    {{-- modal tambah user --}}
    <div class="modal fade" id="tambah-rek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('tambah.rekening')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Customer</label>
                    <select class="form-control @error('name') is-invalid @enderror" id="name"
                      placeholder="Nama Customer" name="name">
                      <option value="">--Pilih Nasabah--</option>
                      @foreach ($user as $rk)
                      <option value="{{ $rk->name }}" name="nama_nasabah">{{ $rk->name }}</option>
                      @endforeach
                    </select>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="rekening">No. Rekening</label>
                    <input type="text" class="form-control @error('rekening') is-invalid @enderror" id="rekening"
                      placeholder="No. Rekening" name="rekening" value="{{ old('rekening') }}" required>

                    @error('rekening')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="pin">PIN Customer</label>
                    <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin"
                      placeholder="PIN Customer" name="pin" value="{{ old('pin') }}" required>

                    @error('pin')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="saldo">Saldo Customer</label>
                    <input type="text" class="form-control @error('saldo') is-invalid @enderror" id="saldo"
                      placeholder="Saldo Customer" name="saldo" value="{{ old('saldo') }}" required>

                    @error('saldo')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.container-fluid -->
  @endsection