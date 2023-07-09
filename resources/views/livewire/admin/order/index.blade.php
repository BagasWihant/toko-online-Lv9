<div class="">
    @if ($this->statusPage != 'detail')
        <div class="card">

            <div class="table-responsive">
                <table class="table align-items-center mb-0">

                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Order
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detail
                                Produk
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status
                                Pembayaran
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $d)
                            <tr wire:click='detail({{ $d->id }})'>
                                <td>
                                    <h6 class="mb-0 text-xs">{{ date('d-m-Y H:i', strtotime($d->created_at)) }}</h6>
                                </td>
                                <td>
                                    @foreach ($d->orderDetail as $detail)
                                        <h6 class="mb-0 text-xs">
                                            {{ $detail->produk->name }}
                                            ({{ $detail->produkWarna ? $detail->produkWarna->warna : 'random' }})
                                            x {{ $detail->qty }} pcs
                                        </h6>
                                    @endforeach
                                </td>
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $d->status_pembayaran }}</h6>
                                </td>
                                <td class="align-middle">
                                    <button wire:click="detail({{ $d->id }})"
                                        class="btn btn-link text-warning text-gradient ">
                                        <span class="btn-inner--icon"><i class="fas fa-info me-2"></i>Detail</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div>
            {{ $data->links('layouts/pagination') }}
        </div>
    @else
        {{-- MODE DETAIL --}}
        <div class="">
            <button wire:click='kembaliSemula' class="btn btn-primary bg-gradient-primary p-2 ">
                <i class="fas fa-chevron-left font-weight-bolder"></i>
                kembali
            </button>
        </div>

        <div class="card my-2">
            <h6 class="mx-3 my-1">Infomasi User</h6>
            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <td class="w-40 font-weight-bolder">Nama Lengkap</td>
                            <td class="">:</td>
                            <td class="w-60 word-wrap-anywhere px-1">{{ $dataOrder->userDetail->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bolder">No. Telp</td>
                            <td>:</td>
                            <td>{{ $dataOrder->userDetail->no_telp }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bolder">E-mail</td>
                            <td>:</td>
                            <td>{{ $dataOrder->userDetail->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bolder">Alamat Lengkap</td>
                            <td>:</td>
                            <td class="word-wrap-anywhere ">{{ $dataOrder->userDetail->fulltext_alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="card -my-2">
            <div class="d-flex justify-content-between mx-3 my-1">
                <h6 class="">{{ $dataOrder->transaksi_id }}</h6>
                <h6 class="">{{ $dataOrder->status_pembayaran }}</h6>
            </div>
            <hr class="m-0">
            <div class="card-body">
                @foreach ($dataOrder->orderDetail as $orderDetail)
                    <div class="d-flex justify-content-start py-3">
                        <img class="w-20 border-radius-md img-card-sm "
                            src="{{ asset($orderDetail->produk->productImage[0]->gambar) }}">
                        <div class="d-flex flex-column">
                            <span class="mx-3 h6">{{ $orderDetail->produk->name }}</span>
                            <span class="mx-3">Warna/Jenis :
                                {{ $orderDetail->produkWarna ? $orderDetail->produkWarna->warna : 'null' }}</span>
                            <span class="mx-3">{{ $orderDetail->qty }} barang</span>
                            <span class="mx-3">Rp.
                                {{ number_format($orderDetail->produk->harga_jual * $orderDetail->qty) }}</span>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0">Total Belanja</h6>
                        <span>Rp. {{ number_format($dataOrder->total_harga) }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($dataOrder->status_pembayaran == 'Paid' && $dataOrder->status_order == null)
            <div class="card my-4">
                <button wire:click='proses({{ $dataOrder->id }})'
                    class="btn btn-primary bg-gradient-primary h5 m-0">setujui dan proses </button>
            </div>
        @elseif($dataOrder->status_pembayaran == 'Paid' && $dataOrder->status_order == 1)
            <div class="card my-4">
                <button wire:click='kirim({{ $dataOrder->id }})'
                    class="btn btn-success bg-gradient-success h5 m-0">Kirim ke pembeli </button>
            </div>
        @elseif($dataOrder->status_pembayaran == 'Paid' && $dataOrder->status_order == 2)
            <div class="card my-4">
                <button
                    class="btn btn-secondary disable bg-gradient-secondary h5 m-0">Sedang dikirim </button>
            </div>
        @elseif($dataOrder->status_pembayaran == 'Paid' && $dataOrder->status_order == 0)
            <div class="card my-4">
                <button
                    class="btn btn-secondary disable bg-gradient-secondary h5 m-0">Transaksi Selesai </button>
            </div>
        @endif
    @endif
</div>
