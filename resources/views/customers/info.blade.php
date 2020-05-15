@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Info Iekening</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <div class="container">
            <div class="saldo">
              <h3>Saldo Anda Saat Ini :</h3>
              <div class="uang">
                @foreach ($rekening as $datarek)
                Rp. {{$datarek->saldo}}
                @endforeach
              </div>
            </div>
          </div>

          <a href="/home"><button type="button" class="btn btn-primary">Kembali</button></a>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection