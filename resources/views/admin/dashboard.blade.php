@extends('layouts.admin')

@section('content')
    dashboard
    <div class="spinner-grow text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <button type="button" class="btn btn-facebook btn-icon">
        <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
        <span class="btn-inner--text">Facebook</span>
    </button>
@endsection
