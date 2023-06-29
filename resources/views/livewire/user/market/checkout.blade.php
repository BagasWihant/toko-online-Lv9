<div class="container-fluid my-4 ">
    <div class="card">
        <div class="container-fluid">
            <div class="row">
                <h6>
                    Total Barang Belanjaan
                    <span class="float-end text-danger ">Rp. {{ number_format($keranjang['total']) }}</span>
                </h6>
                <h5 class="mt-5">Alamat Pengiriman</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td class="w-40 font-weight-bolder">Nama Lengkap</td>
                                <td class="">:</td>
                                <td class="w-60 word-wrap-anywhere px-1">{{ $data->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">No. Telp</td>
                                <td>:</td>
                                <td>{{ $data->no_telp }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">E-mail</td>
                                <td>:</td>
                                <td>{{ $data->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Alamat Lengkap</td>
                                <td>:</td>
                                <td class="word-wrap-anywhere ">{{ $data->fulltext_alamat }}</td>
                            </tr>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <button wire:click='buat_pesanan' class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">
        Buat pesanan
    </button>

    <input type="hidden" id="snaptoken" value="{{ $snapToken }}">
</div>


@push('midtrans-top')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush


@push('script')
    <script>
        window.addEventListener('midtrans__token', event => {
            let snapToken = $('#snaptoken').val();
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Menunggu Pembayaran',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: function(result) {
                    console.log(result);
                    Swal.fire({
                        icon: 'error',
                        title: 'pembayaran GAGAl',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onClose: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'you closed the popup without finishing the payment',
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            })
        })
    </script>
@endpush
