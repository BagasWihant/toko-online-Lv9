@extends('layouts.app')
@section('title', 'Checkout')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')
@livewire('user.market.checkout')
@stack('script')

@endsection
