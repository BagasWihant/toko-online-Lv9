<div class="container-fluid">
    <h5 class="text-primary my-3 mx-3 text-gradient">Daftar Keranjang</h5>
    @php
        $totalHarga = 0;
        $totalQty = 0;
    @endphp
    @forelse ($data as $p)
        <div class="card card-profile my-3">
            <div class="row ">
                <div class="col-md-5 align-items-stretch">
                    <div class="position-relative">
                        <div class="blur-shadow-image">
                            <img class="w-100 border-radius-md img-card page-header"
                                src="{{ asset($p->produk->productImage[0]->gambar) }}">
                            {{-- <img class="w-100 rounded-3 shadow-lg img-card-xl"
                            src="{{ asset($produk->productImage[0]->gambar) }}"> --}}
                            @if ($p->produk->jumlah > 10)
                                <span class="notify-badge-img-green">Stok Tersedia</span>
                            @elseif ($p->produk->jumlah <= 10 && $p->produk->jumlah > 0)
                                <span class="notify-badge-img-warning">Stok tinggal {{ $p->produk->jumlah }}</span>
                            @else
                                <span class="notify-badge-img-red">Stok Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-7 ps-0 my-auto">
                    <div class="card-body text-left">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="p-md-0 pt-3">
                                    <h5 class="font-weight-bolder h3 mb-0">{{ $p->produk->name }}</h5>
                                    <p class="text-uppercase h4 font-weight-bold mb-2"> Rp.
                                        {{ number_format($p->produk->harga_jual) }}
                                    </p>
                                </div>
                                <div class="">
                                    <h6 for="">Tipe / Warna</h6>
                                    <div class="">
                                        <label class="form-check-label">
                                            {{ $p->warna->warna }}
                                        </label>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 for="">Kuantitas</h6>
                                    <div class="input-group ">
                                        <button class="input-group-text"
                                            wire:click='minQty({{ $p->id }})'>-</button>
                                        <input type="number" min="1" class="w-10" value="{{ $p->quantity }}"
                                            style="border: 1px solid #d2d6da;">
                                        <button class="input-group-text"
                                            wire:click='plusQty({{ $p->id }})'>+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h5>TOTAL</h5>
                                <h5 class="">Rp. {{ number_format($p->produk->harga_jual * $p->quantity) }}</h5>
                                @php
                                    $totalHarga += $p->produk->harga_jual * $p->quantity;
                                    $totalQty += $p->quantity;

                                @endphp
                                <button class="btn btn-danger  bg-gradient-danger"
                                    wire:click='hapus({{ $p->id }})'>Hapus</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="position-fixed tombol-ngambang">
            <div class="card shadow-lg flex">
                <div class="card-body text-center p-3 align-item-center">
                    <span class="font-weight-bolder">Total Pesanan:
                        <span class="text-primary">
                            {{ number_format($totalHarga) }}
                        </span>
                    </span>
                    <a wire:click='checkout'
                        class="font-weight-bolder btn-success bg-gradient-success rounded-3 p-2 m-0 btn">
                        Checkout
                    </a>

                </div>
            </div>
            {{-- <a class="fixed-plugin-button bg-gradient-success text-dark position-fixed px-3 py-2">
                <i class="fa fa-send py-2"> </i> <span class="h5">CHECKOUT</span>
            </a> --}}
        </div>
    @empty
        <div class="col-md-12 text-center my-5">
            <span class="text-primary h4 text-gradient">Produk Belum Ada</span>
        </div>
    @endforelse
</div>


