@extends('layouts.app')
@section('title', 'Semua Kategori')
@section('nav-menu') @include('layouts.nav-menu') @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($kategori as $kat)
                <div class="col-md-3 d-flex align-items-stretch mb-3">
                    <div class="card card-profile mt-md-0 mt-5">
                        <a href="{{ url('/kategori/'.$kat->slug) }}">
                            <div class="p-3">
                                <img class="w-100 border-radius-md img-card"
                                    src="{{ asset($kat->image) }}">
                            </div>
                            <div class="card-body blur justify-content-center text-center mx-4 mb-4 border-radius-md">
                                <h4 class="mb-0">{{ $kat->name }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
