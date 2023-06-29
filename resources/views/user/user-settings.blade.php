@extends('layouts.app')

@section('title', 'Setting')

@section('nav-menu') @endsection

@section('content')

    @livewire('user.user-settings')

    @stack('script')

@endsection
