<div class="container-fluid">
    <h5 class="text-primary my-3 mx-3 text-gradient">Daftar Wishlist</h5>
    <div class="row">
        @foreach ($data as $p)
            <div class="col-md-3 col-xl-2 d-flex align-items-stretch mb-3">
                <div class="card card-profile mt-md-0 ">
                    <a href="{{ url('/detail/' . $p->produk->category->slug . '/' . $p->produk->slug) }}">
                        <div class="p-3">
                            <img class="w-100 border-radius-md img-card"
                                src="{{ asset($p->produk->productImage[0]->gambar) }}">
                            @if ($p->produk->jumlah > 10)
                                <span class="notify-badge-img-green">Stok Tersedia</span>
                            @elseif ($p->produk->jumlah <= 10 && $p->produk->jumlah > 0)
                                <span class="notify-badge-img-warning">Stok tinggal {{ $p->produk->jumlah }}</span>
                            @else
                                <span class="notify-badge-img-red">Stok Habis</span>
                            @endif
                        </div>
                        <div class="card-body blur border-radius-md">
                            <h4 class="mb-0">{{ $p->produk->name }}</h4>
                            <h5 class="text-gradient text-primary mb-1">Rp. {{ number_format($p->produk->harga_jual) }}
                            </h5>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-12">

                            <button class="btn-sm btn btn-danger w-100 bg-gradient-danger"
                                wire:click='hapusWishlist({{ $p->id }})'><i
                                    class="fas fa-trash icon-button-sm mx-1"></i> Hapus Dari Wishlist</button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
