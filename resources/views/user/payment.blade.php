@extends('layouts.app')
@section('title', 'Checkout')
@section('nav-menu') @include('layouts.nav-menu') @endsection

@push('midtrans-top')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@section('content')
<input type="hidden" id="snaptoken" value="{{ $token }}">

<script>
    $(function(){
        let snapToken = $('#snaptoken').val();
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil',
                    showConfirmButton: false,
                    timer: 2500
                })
                location.href = '/keranjang?status=success';


            },
            onPending: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Menunggu Pembayaran',
                    showConfirmButton: false,
                    timer: 2500
                })
                location.href = '/keranjang?status=waiting';

            },
            onError: function(result) {
                Swal.fire({
                    icon: 'error',
                    title: 'pembayaran GAGAl',
                    showConfirmButton: false,
                    timer: 2500
                })
                location.href = '/keranjang?status=err';

            },
            onClose: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'you closed the popup without finishing the payment',
                    showConfirmButton: false,
                    timer: 2500
                })
                location.href = '/keranjang?status=failed';
            }
        })
    })
</script>
@endsection
