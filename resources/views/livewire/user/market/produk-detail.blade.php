
<div class="container-fluid">
    <div class="card card-profile ">
        <div class="row">
            <div class="col-md-5 align-items-stretch">
                <div class="position-relative">
                    <div class="blur-shadow-image">
                        <img class="w-100 rounded-3 shadow-lg img-card-xl"
                            src="{{ Storage::url($produk->productImage[0]->gambar) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-7 ps-0 my-auto">
                <div class="card-body text-left">
                    <div class="p-md-0 pt-3">
                        <h5 class="font-weight-bolder mb-0">{{ $produk->name }}</h5>
                        <p class="text-uppercase text-sm font-weight-bold mb-2">{{ $produk->harga_jual }}</p>
                    </div>
                    <p class="mb-4">{{ $produk->deskripsi }}</p>
                    <div class="">

                        <label for="">Tipe / Warna</label>
                        {{ $produk->productWarna[0]->warna }} => {{ $produk->productWarna[0]->qty }}
                    </div>
                    <button type="button" class="btn btn-facebook btn-simple btn-lg mb-0 pe-3 ps-2">
                        <i class="fab fa-facebook" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-twitter btn-simple btn-lg mb-0 px-2">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-github btn-simple btn-lg mb-0 px-2">
                        <i class="fab fa-github" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
