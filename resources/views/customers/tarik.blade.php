@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Transfer</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form role="form" method="POST" action="{{ route('tarik.saldo')}}">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="text" class="form-control @error('nominal') is-invalid @enderror" id="nominal"
                  placeholder="Nominal" name="nominal" value="{{ old('nominal') }}" required>

                @error('nominal')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/home"><button type="button" class="btn btn-primary ml-lg-5">Kembali</button></a>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection