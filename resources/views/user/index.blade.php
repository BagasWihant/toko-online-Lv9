@extends('layouts.app')
@section('title', 'Home')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-4">
            @foreach ($slider as $sld)
                <div class="carousel-item @if ($loop->index == 0) active @else '' @endif">
                    <div class="page-header min-vh-50 m-3 border-radius-xl"
                        style="background-image: url('{{ asset($sld->image) }}');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h1 class="text-white fadeIn2 fadeInBottom">{{ $sld->title }}</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">{{ $sld->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="min-vh-50 position-absolute w-100 top-0 bagashidemd">
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <h4 class="my-5">Semua Kategori</h4 >
        <div class="row">
            @foreach ($kategori as $kat)
                <div class="col-md-3 d-flex align-items-stretch mb-3">
                    <div class="card card-profile mt-md-0 mt-5 w-100">
                        <a href="{{ url('/kategori/'.$kat->slug) }}">
                            <div class="p-3">
                                <img class="w-100 border-radius-md img-card"
                                    src="{{ asset($kat->image) }}">
                            </div>
                            <div class="card-body blur justify-content-center text-center mx-4 mb-4 border-radius-md">
                                <h4 class="mb-0 text-gradient text-info text-uppercase">{{ $kat->name }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
