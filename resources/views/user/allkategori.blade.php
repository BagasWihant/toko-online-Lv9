@extends('layouts.app')
@section('title', 'Semua Kategori')
@section('nav-menu') @include('layouts.nav-menu') @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($kategori as $kat)
                <div class="col-md-3 d-flex align-items-stretch mb-3">
                    <div class="card card-profile mt-md-0 mt-5">
                        <a href="javascript:;">
                            <div class="p-3">
                                <img class="w-100 border-radius-md img-card"
                                    src="{{ Storage::url($kat->image) }}">
                            </div>
                        </a>
                        <div class="card-body blur justify-content-center text-center mx-4 mb-4 border-radius-md">
                            <h4 class="mb-0">{{ $kat->name }}</h4>
                            <div class="row justify-content-center text-center">
                                <div class="col-12 mx-auto">
                                    <h5 class="text-info mb-0">750</h5>
                                    <small>Projects</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
