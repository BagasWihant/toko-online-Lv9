<div class="container-fluid">
    <div class="d-flex justify-content-end">
        <button
            class="fixed-plugin-button1 btn btn-link text-gradient text-primary text-lg font-weight-bolder">Filter</button>
    </div>

    <div wire:ignore.self class="modal fade" id="masukKeranjang" tabindex="-1" role="dialog" data-bs-keyboard="false"
        aria-labelledby="masukKeranjang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="clearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="font-weight-bolder text-center text-success text-gradient">Tambah Keranjang</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" id="formmasukKeranjang" wire:submit.prevent="masukKeranjang"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="">
                                    <h6 for="">Tipe / Warna</h6>
                                    <div class="">
                                        <div class="row mx-3">
                                            @foreach ($productWarna as $warna)
                                                <div class="form-check col-sm-6 col-md-6">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault" id="radio{{ $warna->id }}"
                                                        wire:click='pilihWarna({{ $warna->id }})'>
                                                    <label class="form-check-label" for="radio{{ $warna->id }}">
                                                        {{ $warna->warna }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if ($kondisi == 'modal')
                                    <div class="">
                                        <h6 for="">Kuantitas</h6>
                                        <div class="input-group ">
                                            <span class="input-group-text" wire:click='minQty'>-</span>
                                            <input type="number" min="1" class="w-10" wire:model='qty'
                                                style="border: 1px solid #d2d6da;">
                                            <span class="input-group-text"
                                                wire:click='plusQty({{ $keranjang->jumlah }})'>+</span>
                                        </div>
                                        @if ($jumlahWarnaIni > 0)
                                            <label for="">Tersisa {{ $jumlahWarnaIni }}</label>
                                        @else
                                            <label for="">Tersisa {{ $keranjang->jumlah }}</label>
                                        @endif
                                    </div>
                                @endif

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">Tambah</button>

                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto" id="popopol">

                                {{-- Don't have an account?
                            <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($produk as $p)
            <div class="col-md-3 col-xl-2 d-flex align-items-stretch mb-3">
                <div class="card card-profile mt-md-0 ">
                    <a href="{{ url('/detail/' . $p->category->slug . '/' . $p->slug) }}">
                        <div class="p-3">
                            <img class="w-100 border-radius-md img-card" src="{{ asset($p->productImage[0]->gambar) }}">
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
                            <h5 class="text-gradient text-primary mb-1">Rp. {{ number_format($p->harga_jual) }}</h5>
                    </a>
                    <div class="row">

                        <button wire:click='getData({{ $p->id }})'
                            class="btn-sm btn btn-success w-100 bg-gradient-success" data-bs-toggle="modal"
                            data-bs-target="#masukKeranjang"><i class="fas fa-cart-plus icon-button-sm mx-1 mb-0"></i>
                            Keranjang</button>

                        <button class="btn-sm btn btn-danger w-100 bg-gradient-danger"
                            wire:click='masukWishlist({{ $p->id }})'><i
                                class="fas fa-heart icon-button-sm mx-1"></i> Wishlist</button>

                    </div>
                </div>
            </div>
    </div>
    @empty
        <div class="col-md-12 text-center my-5">
            <span class="text-primary h4 text-gradient">Produk Belum Ada</span>
        </div>
    @endforelse
</div>
<div class="fixed-plugin1" wire:ignore.self>
    <div class="card shadow-lg " >
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
        <div class="card-body pt-sm-3 pt-0  navbar-vertical" >
            <!-- Sidebar Backgrounds -->

            <div class="menu">
                <div class="item"><a class="nav-link d-block">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" id="floatingInput" wire:model='findMinHarga'
                                    placeholder="Min. Harga">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" id="floatingInput1" wire:model='findMaxHarga'
                                    placeholder="Max. Harga">
                            </div>
                        </div>
                </div>

                <div class="item">
                    <button wire:click='searching'
                    class="btn btn-succes bg-gradient-success d-block w-100">
                        <i class="fas fa-shopping-cart"></i>Cari
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        window.addEventListener('modal-hide', event => {
            $('#masukKeranjang').modal('hide')
        })
    </script>
@endpush
