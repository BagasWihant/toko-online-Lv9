@extends('layouts.app')
@section('title', "$produk->name")
@section('nav-menu') @include('layouts.nav-menu') @endsection
@section('content')
    @livewire('user.market.produk-detail',['produk'=>$produk])
    {{-- {{ dd($produk) }} --}}
   {{-- <livewire:user.market.produk-detail :produk="$produk" :kategori="$kategori"/> --}}
@endsection
