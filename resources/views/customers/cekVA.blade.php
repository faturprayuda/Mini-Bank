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
            <form role="form" method="POST" action="{{ route('transfer.proses.va')}}">
              @csrf
              <div class="cek-tf">
                <h3>Anda Akan Mengirim Uang dengan Tujuan :</h3>
                <table id="example2" class="table table-bordered table-hover">

                  <tr>
                    <th>Nama</th>
                    <td>
                      <input type="text" class="form-control @error('norek') is-invalid @enderror" id="norek"
                        placeholder="Nomor Rekening" name="norek" value="{{ $nama }}" disabled>
                    </td>
                  </tr>

                  <tr>
                    <th>Nomor Virtual Account</th>
                    <td>
                      <input type="text" class="form-control @error('norek') is-invalid @enderror" id="norek"
                        placeholder="Nomor Rekening" name="norek" value="{{ $no_va }}" disabled>
                    </td>
                  </tr>

                  <tr>
                    <th>Nominal</th>
                    <td>
                      <input type="text" class="form-control @error('norek') is-invalid @enderror" id="norek"
                        placeholder="Nomor Rekening" name="norek" value="Rp.{{ $bill }}" disabled>
                    </td>
                  </tr>
                </table>
              </div>

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
</div>
@endsection