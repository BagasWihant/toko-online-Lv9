@extends('layouts.app')
@section('title', 'Wishlist')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')
@livewire('user.market.wishlist')


@endsection
