@extends('layouts.app')
@section('title', 'Keranjang')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')
@livewire('user.market.keranjang')
@stack('script')

@endsection
