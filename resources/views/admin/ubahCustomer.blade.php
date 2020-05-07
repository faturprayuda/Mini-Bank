@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Ubah Data Customer')

{{-- main title --}}
@section('main title', 'Ubah Data Customer')

@section('content')
<!-- general form elements -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Quick Example</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="post" action="/customer/update/{{$user->id}}">
    {{ csrf_field() }}
    {{ method_field('put') }}

    <div class="card-body">
      <div class="form-group">
        <label for="name">Nama Customer</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
          placeholder="Nama Customer" name="name" value="{{ $user->name }}" required>

        @if($errors->has('name'))
        <div class="text-danger">
          {{ $errors->first('name')}}
        </div>
        @endif
      </div>

      <div class="form-group">
        <label for="email">Email Customer</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
          placeholder="Email Customer" name="email" value="{{ $user->email }}" required>

        @if($errors->has('email'))
        <div class="text-danger">
          {{ $errors->first('email')}}
        </div>
        @endif
      </div>

      <div class="form-group">
        <label for="address">Alamat Customer</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
          placeholder="Alamat Customer" name="address" value="{{ $user->address }}" required>

        @if($errors->has('address'))
        <div class="text-danger">
          {{ $errors->first('address')}}
        </div>
        @endif
      </div>

      <div class="form-group">
        <label for="phone">No. Telepon Customer</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
          placeholder="No. Telepon Customer" name="phone" value="{{ $user->no_phone }}" required>

        @if($errors->has('phone'))
        <div class="text-danger">
          {{ $errors->first('phone')}}
        </div>
        @endif
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
          placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password-confirm"
          placeholder="Confirm Password" name="password_confirmation" value="{{ old('password') }}" required
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
@endsection