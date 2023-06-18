<div class="container-fluid">
    <div class="card card-profile ">
        <div class="row">
            <div class="col-md-5 align-items-stretch">
                <div class="position-relative">
                    <div class="blur-shadow-image">
                        <img class="w-100 rounded-3 shadow-lg img-card-xl"
                            src="{{ asset($produk->productImage[0]->gambar) }}">
                        @if ($jumlahWarnaIni > 10)
                            <span class="notify-badge-img-green">Stok Tersedia</span>
                        @elseif ($jumlahWarnaIni <= 10 && $jumlahWarnaIni > 0)
                            <span class="notify-badge-img-warning">Stok tinggal {{ $jumlahWarnaIni }}</span>
                        @else
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-7 ps-0 my-auto">
                <div class="card-body text-left">
                    <div class="p-md-0 pt-3">
                        <h5 class="font-weight-bolder h3 mb-0">{{ $produk->name }}</h5>
                        <p class="text-uppercase h4 font-weight-bold mb-2"> Rp. {{ number_format($produk->harga_jual) }}
                        </p>
                    </div>
                    <div class="mt-5">
                        <h6 for="">Tipe / Warna</h6>
                        <div class="">
                            <div class="row mx-3">
                                @foreach ($produk->productWarna as $warna)
                                    <div class="form-check col-sm-3 col-md-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="radio{{ $warna->id }}" wire:click='pilihWarna({{ $warna->id }})'>
                                        <label class="form-check-label" for="radio{{ $warna->id }}">
                                            {{ $warna->warna }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h6 for="">Kuantitas</h6>
                        <div class="input-group ">
                            <button class="input-group-text" wire:click='minQty'>-</button>
                            <input type="number" min="1" class="w-10"
                                wire:model='qty'style="border: 1px solid #d2d6da;">
                            <button class="input-group-text" wire:click='plusQty({{ $produk->jumlah }})'>+</button>
                        </div>
                        @if ($jumlahWarnaIni > 0)
                            <label for="">Tersisa {{ $jumlahWarnaIni }}</label>
                        @else
                            <label for="">Tersisa {{ $produk->jumlah }}</label>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-success w-100 bg-gradient-success" wire:click='masukKeranjang({{ $produk->id }})'><i
                                    class="fas fa-cart-plus" ></i> Keranjang</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-danger w-100 bg-gradient-danger" wire:click='masukWishlist({{ $produk->id }})'><i
                                    class="fas fa-heart"></i> Wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $('#pilihwarna[]').on('click', function() {
            console.log($(this).html);
        })
    </script>
@endpush
