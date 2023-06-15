<div>
    <div class="col-lg-2 col-md-3 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">

        <button class="btn btn-icon btn-3 bg-gradient-info" type="button" data-bs-toggle="modal"
            data-bs-target="#modalProduk">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            <span class="btn-inner--text">Tambah Produk</span>
        </button>
        <!-- Modal tambah kategori-->
        <div wire:ignore.self class="modal modal-lg fade" id="modalProduk" tabindex="-1" role="dialog"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalProduk" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" wire:click="clear"
                            aria-label="Close">
                            <span aria-hidden="true" class="font-weight-bolder">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                @if ($kondisiModal == 'tambah')
                                    <h5 class="font-weight-bolder text-center text-info text-gradient">Tambah Produk
                                    </h5>
                                @else
                                    <h5 class="font-weight-bolder text-center text-warning text-gradient">Update Produk
                                    </h5>
                                @endif
                            </div>
                            <div class="card-body">
                                @if ($kondisiModal == 'tambah')
                                    <form role="form text-left" enctype="multipart/form-data"
                                        wire:submit.prevent="tambahProduk">
                                    @else
                                        <form role="form text-left" enctype="multipart/form-data"
                                            wire:submit.prevent="updateProduk">
                                @endif
                                @if ($errorValidasi)
                                <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Danger!</strong> {{$errorValidasi}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif


                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-data-tab" data-bs-toggle="tab"
                                            wire:ignore.self data-bs-target="#nav-data" type="button" role="tab"
                                            aria-controls="nav-data" aria-selected="true">Data
                                            Produk</button>
                                        <button class="nav-link" id="nav-gambar-tab" data-bs-toggle="tab"
                                            wire:ignore.self data-bs-target="#nav-gambar" type="button" role="tab"
                                            aria-controls="nav-gambar" aria-selected="false">Gambar</button>
                                        <button class="nav-link" id="nav-warna-tab" data-bs-toggle="tab"
                                            wire:ignore.self data-bs-target="#nav-warna" type="button" role="tab"
                                            aria-controls="nav-warna" aria-selected="false">Warna / Jumlah</button>
                                    </div>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    <div wire:ignore.self class="tab-pane fade show active" id="nav-data"
                                        role="tabpanel" aria-labelledby="nav-data-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nama</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        wire:model="name" placeholder="Nama" aria-label="Nama"
                                                        name="name">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger"
                                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Kategori</label>
                                                <div class="input-group">
                                                    <select name="kategori_id" wire:model="kategori_id"
                                                        class="form-control">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($kategori as $k)
                                                            <option value="{{ $k->id }}">{{ $k->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Brand</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('brand') is-invalid @enderror"
                                                        wire:model="brand" placeholder="Brand" aria-label="Brand"
                                                        name="brand">
                                                </div>
                                                @error('brand')
                                                    <span class="text-danger"
                                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Slug / Link</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        wire:model="slug" placeholder="Slug" aria-label="Slug"
                                                        name="slug">
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger"
                                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label>Deskripsi</label>
                                            <div class="input-group">
                                                <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" wire:model="deskripsi"
                                                    placeholder="Deskripsi" aria-label="Deskripsi" name="deskripsi"></textarea>
                                            </div>
                                            @error('deskripsi')
                                                <span class="text-danger"
                                                    style="font-size:0.7rem !important;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Harga</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('harga_jual') is-invalid @enderror"
                                                        wire:model="harga_jual" placeholder="Harga Jual"
                                                        aria-label="Harga Jual" name="harga_jual">
                                                </div>
                                                @error('harga_jual')
                                                    <span class="text-danger"
                                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-check-label" for="status">Tampilkan
                                                    Produk</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" checked="" wire:model="status">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-check-label" for="status">Trending
                                                    Produk</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="trending"
                                                        name="trending" checked="" wire:model="trending">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div wire:ignore.self class="tab-pane fade" id="nav-gambar" role="tabpanel"
                                        aria-labelledby="nav-gambar-tab">
                                        <div class="">
                                            <label>Image</label>
                                            <div class="input-group">
                                                <input type="file" multiple
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    wire:model="image" name="image"
                                                    id="upload{{ $iteration }}">
                                            </div>
                                            @error('image')
                                                <span class="text-danger"
                                                    style="font-size:0.7rem !important;">{{ $message }}</span>
                                            @enderror
                                            <div wire:loading wire:target='image'>
                                                <span class="text-info text-md text-gradient">Uploading <i
                                                        class="fas fa-spinner fa-spin"></i></span>
                                            </div>
                                        </div>
                                        @if ($kondisiModal == 'tambah')
                                            @if ($image)
                                                <div class="row mb-1  justify-content-center">
                                                    @foreach ($image as $img)
                                                        <div class="card move-on-hover col-md-2 mx-2 my-1 text-center">

                                                            <img src="{{ $img->temporaryUrl() }}" alt="preview"
                                                                onclick="previewImage('{{ $img->temporaryUrl() }}')"
                                                                class="w-100 rounded img-cover-100"
                                                                data-bs-target="#previewImage" data-bs-toggle="modal"
                                                                data-bs-dismiss="modal">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @else
                                            @if ($image)
                                                <div class="row mb-1  justify-content-center">
                                                    <span
                                                        class="text-sm font-weight-bolder text-success text-gradient">Gambar
                                                        Baru</span>
                                                    @foreach ($image as $img)
                                                        <div class="card move-on-hover col-md-2 mx-2 my-1 text-center">
                                                            <img src="{{ $img->temporaryUrl() }}" alt="preview"
                                                                onclick="previewImage('{{ $img->temporaryUrl() }}')"
                                                                class="w-100 rounded img-cover-100"
                                                                data-bs-target="#previewImage" data-bs-toggle="modal"
                                                                data-bs-dismiss="modal">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if ($oldImage)
                                                <div class="row mt-1 justify-content-center">
                                                    <h6 class="text-sm font-weight-bolder text-primary text-gradient">
                                                        Gambar Produk</h6>
                                                    @foreach ($oldImage as $img)
                                                        <div class="card move-on-hover col-md-2 mx-2 my-1 text-center"
                                                            id="hapusgambar{{ $img->id }}">
                                                            <div class="">
                                                                <img src="{{ Storage::url($img->gambar) }}"
                                                                    alt="previewADD"
                                                                    onclick="previewImage('{{ Storage::url($img->gambar) }}')"
                                                                    class="w-100 rounded img-cover-150"
                                                                    data-bs-target="#previewImage"
                                                                    data-bs-toggle="modal" data-bs-dismiss="modal">
                                                            </div>
                                                            <button class="btn btn-sm mt-1 bg-gradient-danger"
                                                                type="button"
                                                                wire:click="hapusGambar({{ $img->id }})">Hapus</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        @endif
                                    </div>
                                    <div wire:ignore.self class="tab-pane fade text-center" id="nav-warna"
                                        role="tabpanel" aria-labelledby="nav-warna-tab">
                                        @if($productWarna)
                                        @foreach ($productWarna as $index=>$value)
                                            <div class="row">
                                                <div class="col-7">
                                                    <label>Warna / Tipe</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" wire:model="color.{{ $index }}">
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <label for="">Jumlah</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" required
                                                            wire:model="qty.{{ $index }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                        @foreach ($warna as $key => $value)
                                            <div class="row">
                                                <div class="col-7">
                                                    <label>Warna / Tipe</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" required
                                                            wire:model="color.{{ $value }}">
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <label for="">Jumlah</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" required
                                                            wire:model="qty.{{ $value }}">

                                                        @error('qty.{{ $value }}')
                                                            <span class="text-danger"
                                                                style="font-size:0.7rem !important;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <button class="btn bg-gradient-warning btn-circle-md" type="button"
                                            wire:click="tambahWarna({{ $totalWarna }})"><i
                                                class="fas fa-plus-circle"></i></button>


                                    </div>
                                </div>
                                <div class="text-center">
                                    @if ($kondisiModal == 'tambah')
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0"
                                            wire:submit.prevent="tambahProduk">Tambah
                                            <i wire:loading wire:target='tambahProduk' class="fas fa-spinner fa-spin"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0"
                                            wire:prevent="updateProduk">
                                            Update
                                            <i wire:loading wire:target='updateProduk' class="fas fa-spinner fa-spin"></i>
                                        </button>
                                    @endif

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="hapusKategori" tabindex="-1" role="dialog"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="hapusKategori" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="font-weight-bolder text-center text-danger text-gradient">Apakah yakin
                                    menghapus produk {{ $name }}?</h5>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" wire:submit.prevent="hapusProduk"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <button type="button" data-bs-dismiss="modal" aria-label="Close"
                                                    wire:click="clearForm"
                                                    class="btn btn-round bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Batal</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <button
                                                    type="submit"class="btn btn-round bg-gradient-danger btn-lg w-100 mt-4 mb-0">Ya
                                                    !</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal image -->
        <div class="modal fade" id="previewImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="previewImageLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="" id="srcPreviewImage" style="width: 100%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-target="#modalProduk"
                            data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Nama Produk</th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Kategori
                        </th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Harga</th>
                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Jumlah</th>
                        {{-- <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Gambar</th> --}}
                        <th
                            class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2 text-center">
                            AKsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->category->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->harga_jual }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2">
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-sm">{{ $d->jumlah }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a wire:click="getID({{ $d->id }})" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalProduk" class="btn btn-link text-warning text-gradient">
                                    <span class="btn-inner--icon"><i class="fas fa-edit me-2"></i>edit</span>
                                </a>
                                <button wire:click="getID({{ $d->id }})"
                                    class="btn btn-link text-danger text-gradient " type="button"
                                    data-bs-toggle="modal" data-bs-target="#hapusKategori">

                                    <span class="btn-inner--icon"><i class="fas fa-trash me-2"></i>delete</span>
                                </button>
                                @if ($d->status == '1')
                                    <button wire:click="hide({{ $d->id }})"
                                        class="btn btn-link text-success text-gradient" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-eye me-2"></i>tampilkan<i
                                                wire:target="hide({{ $d->id }})" wire:loading
                                                class="fas fa-spinner fa-spin"></i></span>
                                    </button>
                                @else
                                    <button wire:click="show({{ $d->id }})"
                                        class="btn btn-link text-primary text-gradient" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-eye-slash"></i>sembunyikan<i
                                                wire:target="show({{ $d->id }})" wire:loading
                                                class="fas fa-spinner fa-spin"></i></span>
                                    </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $data->links('layouts/pagination') }}
        </div>
    </div>

</div>
@push('script')
    <script>
        window.addEventListener('modalhide', event => {
            $('#modalProduk').modal('hide')
        })
        window.addEventListener('hapusKategori', event => {
            $('#hapusKategori').modal('hide')
        })
        window.addEventListener('updateKategori', event => {
            $('#updateKategori').modal('hide')
        })

        function previewImage(src) {
            $('#srcPreviewImage').attr('src', src)
        }
    </script>
@endpush
