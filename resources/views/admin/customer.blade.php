@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Customer')

{{-- main title --}}
@section('main title', 'Data Customer')

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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-user-plus"></i> Tambah Customer
              </button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($user as $userdata)
                <td>{{ $userdata->name }}</td>
                <td>{{ $userdata->email }}</td>
                <td>{{ $userdata->address }}</td>
                <td>{{ $userdata->no_phone }}</td>
                <td><a href="admin/customer/edit/{{ $userdata->id }}" class="badge badge-warning"
                    style="color: white">Ubah</a> |
                  <a href="admin/customer/hapus/{{ $userdata->id }}" class="badge badge-danger">Hapus</a>
                </td>
                @endforeach
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No Telepon</th>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
              <form role="form" method="POST" action="{{ route('tambah.data')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                      placeholder="Nama Customer" name="name" value="{{ old('name') }}" required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email Customer</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      placeholder="Email Customer" name="email" value="{{ old('email') }}" required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="address">Alamat Customer</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                      placeholder="Alamat Customer" name="address" value="{{ old('address') }}" required>

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="phone">No. Telepon Customer</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                      placeholder="No. Telepon Customer" name="phone" value="{{ old('phone') }}" required>

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                      placeholder="Password" name="password" value="{{ old('password') }}" required
                      autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                      placeholder="Confirm Password" name="password" value="{{ old('password') }}" required
                      autocomplete="new-password">
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