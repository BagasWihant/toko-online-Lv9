@extends('layouts.app')
@section('title', "Kategori $kategori->name")
@section('nav-menu') @include('layouts.nav-menu') @endsection
@section('content')
    {{-- @livewire('user.market.produk.produk-kategori',['produk'=>$produk]) --}}
    {{-- {{ dd($produk) }} --}}
   <livewire:user.market.produk.produk-kategori :produk="$produk" :kategori="$kategori"/>
@endsection
@stack('script')
