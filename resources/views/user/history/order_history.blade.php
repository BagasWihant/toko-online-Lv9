@extends('layouts.app')
@section('title', 'Histori Pembelian')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Nama Produk</th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Harga</th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Jumlah</th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Status</th>
                        {{-- <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Gambar</th> --}}
                        {{-- <th
                        class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2 text-center">
                        AKsi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $d)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div class="my-auto">
                                        {{ $d->id }}
                                        @foreach ($d->orderDetail as $detail)
                                            <h6 class="mb-0 text-sm">{{ $detail->produk->name }}</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->total_harga }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->qty }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        @if ($d->status == 'Paid')
                                        @else
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="mb-0 text-sm">{{ $d->status }}
                                                    </h6>
                                                </div>
                                                <div class="col-6">

                                                    <a href="{{ route('payment',['trx'=>$d->transaksi_id, 'payToken' => $d->payToken ? $d->payToken : 'null']) }}"
                                                        class="btn btn-sm bg-gradient btn-success">bayar</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            {{-- <td>
                            <a wire:click="getID({{ $d->id }})" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalProduk" class="btn btn-link text-warning text-gradient">
                                <span class="btn-inner--icon"><i class="fas fa-edit me-2"></i>edit</span>
                            </a>
                            <button wire:click="getID({{ $d->id }})"
                                class="btn btn-link text-danger text-gradient " type="button"
                                data-bs-toggle="modal" data-bs-target="#hapusKategori">

                                <span class="btn-inner--icon"><i class="fas fa-trash me-2"></i>delete</span>
                            </button>
                            @if ($d->status == '1')
                                <button wire:click="hide({{ $d->id }})"
                                    class="btn btn-link text-success text-gradient" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-eye me-2"></i>tampilkan<i
                                            wire:target="hide({{ $d->id }})" wire:loading
                                            class="fas fa-spinner fa-spin"></i></span>
                                </button>
                            @else
                                <button wire:click="show({{ $d->id }})"
                                    class="btn btn-link text-primary text-gradient" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-eye-slash"></i>sembunyikan<i
                                            wire:target="show({{ $d->id }})" wire:loading
                                            class="fas fa-spinner fa-spin"></i></span>
                                </button>
                            @endif
                        </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $history->links('layouts/pagination-not-livewire') }}
        </div>
    </div>
@endsection
