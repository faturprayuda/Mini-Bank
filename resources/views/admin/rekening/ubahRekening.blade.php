@extends('admin.layouts.layoutAdmin')

{{-- title bar --}}
@section('title', 'Halaman Ubah Data Rekening Customer')

{{-- main title --}}
@section('main title', 'Ubah Data Rekening Customer')

@section('content')
<!-- general form elements -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Quick Example</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="post" action="/rekening/update/{{$rekening->id}}">
    {{ csrf_field() }}
    {{ method_field('put') }}

    <div class="card-body">
      <div class="form-group">
        <label for="name">Nama Customer</label>
        <input type="text" class="form-control id=" name" placeholder="Nama Customer" name="name"
          value="{{ $rekening->user->name }}" disabled>

        <div class="form-group">
          <label for="rekening">Nomor Rekening</label>
          <input type="email" class="form-control id=" rekening" placeholder="Nomor Rekening" name="rekening"
            value="{{ $rekening->no_rekening }}" disabled>

          <div class="form-group">
            <label for="pin">PIN Customer</label>
            <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin"
              placeholder="PIN Customer" name="pin" value="{{ $rekening->pin }}" required>

            @if($errors->has('pin'))
            <div class="text-danger">
              {{ $errors->first('pin')}}
            </div>
            @endif
          </div>

          <div class="form-group">
            <label for="saldo">Saldo Customer</label>
            <input type="text" class="form-control @error('saldo') is-invalid @enderror" id="saldo"
              placeholder="Saldo Customer" name="saldo" value="{{ $rekening->saldo }}" required>

            @if($errors->has('saldo'))
            <div class="text-danger">
              {{ $errors->first('saldo')}}
            </div>
            @endif
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