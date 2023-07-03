@extends('layouts.app')
@section('title', 'Histori Pembelian')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')
<div class="container-fluid">
    @forelse ($history as $d)
        <div class="card my-3">
            <div class="d-flex justify-content-between mx-3 my-1">
                <h6 class="">{{ $d->transaksi_id }}</h6>
                <h6 class="">{{ $d->status_pembayaran }}</h6>
            </div>
            <hr class="m-0">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-2">
                    <img class="w-20 border-radius-md img-card-sm "
                    src="{{ asset($d->orderDetail->first()->produk->productImage[0]->gambar) }}">
                    <div class="">
                        <h6 class="mx-3">{{ $d->orderDetail->first()->produk->name }}</h6>
                        <span class="mx-3">{{ $d->orderDetail->first()->qty }} barang</span>
                    </div>
                </div>

                @if(count($d->orderDetail) > 1)
                <div class="w-100 border d-flex justify-content-center mb-2">
                    <span class="">+{{ count($d->orderDetail)-1 }} produk lainnya</span>
                </div>
                @endif

                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0">Total Belanja</h6>
                        <span>Rp. {{ number_format($d->total_harga) }}</span>
                    </div>
                    <div class="">
                        @if($d->status_pembayaran != 'Paid')
                        <a href="{{ route('payment', ['trx' => $d->transaksi_id, 'payToken' => $d->payToken ? $d->payToken : 'null']) }}" class="btn btn-success bg-gradient btn-sm">Bayar </a>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                {{ $history->links('layouts/pagination-not-livewire') }}
            </div>
        </div>
    @empty
        <div class="col-md-12 text-center my-8">
            <span class="text-primary h3 text-gradient text-uppercase">Belum Ada transaksi</span>
        </div>
    @endforelse
</div>
@endsection
