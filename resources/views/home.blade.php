@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="container">
                        <div class="row menu-icon">
                            <div class="col-lg-4">
                                <div class="info">
                                    <a href="{{ route('customer.info') }}">
                                        <i class="info-icon fas fa-file-invoice-dollar fa-5x"></i>
                                        <p>Info Rekening</p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="transfer">
                                    <a href="{{ route('customer.transfer') }}">
                                        <i class="info-icon fas fa-exchange-alt fa-5x"></i>
                                        <p>Transfer Uang</p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="tarik-tunai">
                                    <a href="{{ route('customer.tarik') }}">
                                        <i class="info-icon fas fa-hand-holding-usd fa-5x"></i>
                                        <p>Tarik Tunai</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection