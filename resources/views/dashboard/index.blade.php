@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
        <div class="row">
            {{--  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{route('dashboard.barang.index')}}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    BARANG
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{$barangs}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cube fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{route('dashboard.suplier.index')}}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    SUPLIER
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{$supliers}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{route('dashboard.stock.index')}}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    DAFTAR STOCK
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{$stock}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{route('dashboard.pembelian.index')}}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    dAFTAR PEMBELIAN
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{$pembelian}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{route('dashboard.detail.pembelian.index')}}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    DETAIL PEMBELIAN
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{$detail_pembelian}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
