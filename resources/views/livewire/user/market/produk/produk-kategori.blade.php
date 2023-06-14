<div class="container-fluid">
    <div class="d-flex justify-content-end">
        <button
            class="fixed-plugin-button1 btn btn-link text-gradient text-primary text-lg font-weight-bolder">Filter</button>
    </div>
    <div class="row">
        @forelse ($produk as $p)
            <div class="col-md-3 col-xl-2 d-flex align-items-stretch mb-3">
                <div class="card card-profile mt-md-0 ">
                    <a href="{{ url('/kategori/' . $p->category->slug . '/' . $p->slug) }}">
                        <div class="p-3">
                            <img class="w-100 border-radius-md img-card"
                                src="{{ Storage::url($p->productImage[0]->gambar) }}">
                            @if ($p->jumlah > 10)
                                <span class="notify-badge-img-green">Stok Tersedia</span>
                            @elseif ($p->jumlah <= 10 && $p->jumlah > 0)
                                <span class="notify-badge-img-warning">Stok tinggal {{ $p->jumlah }}</span>
                            @else
                                <span class="notify-badge-img-red">Stok Habis</span>
                            @endif
                        </div>
                        <div class="card-body blur border-radius-md">
                            <h4 class="mb-0">{{ $p->name }}</h4>
                            <div class="row">
                                <h5 class="text-gradient text-primary mb-1">Rp. {{ $p->harga_jual }}</h5>

                                <button class="btn-sm btn btn-success w-100 bg-gradient-success"><i
                                        class="fas fa-cart-plus icon-button-sm mx-1 mb-0"></i> Keranjang</button>

                                <button class="btn-sm btn btn-danger w-100 bg-gradient-danger"><i
                                        class="fas fa-heart icon-button-sm mx-1"></i> Wishlist</button>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-md-12 text-center my-5">
                <span class="text-primary h4 text-gradient">Produk Belum Ada</span>
            </div>
        @endforelse
    </div>
    <div class="fixed-plugin1">
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Filter Produk</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button1">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0  navbar-vertical">
                <!-- Sidebar Backgrounds -->

                <div class="menu">
                    <div class="item"><a class="nav-link d-block">
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" class="form-control" id="floatingInput"
                                        placeholder="Min. Harga">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" id="floatingInput1"
                                        placeholder="Max. Harga">
                                </div>
                            </div>
                    </div>

                    <div class="item"><a class="nav-link d-block">
                            <i class="fas fa-shopping-cart"></i>Wishlist
                            <span class="ct-docs-sidenav-pro-badge">4</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
