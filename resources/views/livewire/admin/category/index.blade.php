<div>
    <div class="col-lg-2 col-md-3 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">

        <button class="btn btn-icon btn-3 bg-gradient-info" type="button" data-bs-toggle="modal"
            data-bs-target="#tambahKategori">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            <span class="btn-inner--text">Tambah Kategori</span>
        </button>

        <!-- Modal tambah kategori-->
        <div wire:ignore.self class="modal fade" id="tambahKategori" tabindex="-1" role="dialog"
            aria-labelledby="tambahKategori" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="font-weight-bolder text-center text-info text-gradient">Tambah Kategori</h5>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" id="formTambahKategori" wire:submit.prevent="tambahKategori"
                                    enctype="multipart/form-data">
                                    @csrf
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
                                            <label>Slug</label>
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
                                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" wire:model="description"
                                                placeholder="Deskripsi" aria-label="Deskripsi" name="description"></textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger"
                                                style="font-size:0.7rem !important;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="">

                                        <label>Image</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                wire:model="image" name="image" id="upload{{ $iteration }}">
                                        </div>
                                        @error('image')
                                            <span class="text-danger"
                                                style="font-size:0.7rem !important;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Meta Title</label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('meta_title') is-invalid @enderror"
                                                    wire:model="meta_title" placeholder="Meta Title"
                                                    aria-label="Meta Title" name="meta_title">
                                            </div>

                                            @error('meta_title')
                                                <span class="text-danger"
                                                    style="font-size:0.7rem !important;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Meta Keyword</label>
                                            <div class="input-group mb-3">
                                                <input type="text"
                                                    class="form-control @error('meta_keyword') is-invalid @enderror"
                                                    wire:model="meta_keyword" placeholder="Meta Keyword"
                                                    aria-label="Meta Keyword" name="meta_keyword">
                                            </div>

                                            @error('meta_keyword')
                                                <span class="text-danger"
                                                    style="font-size:0.7rem !important;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <label>Meta Deskripsi</label>
                                    <div class="input-group mb-3">
                                        <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror"
                                            wire:model="meta_description" placeholder="Meta Deskripsi" aria-label="Meta Deskripsi" name="meta_description"></textarea>
                                    </div>
                                    <label class="form-check-label" for="status">Tampilkan Kategori</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status"
                                            name="status" checked wire:model="status">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Tambah</button>

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

    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kategori
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        @if ($d->image != '')
                                            <img src="{{ Storage::url($d->image) }}"
                                                class="avatar avatar-sm rounded-circle me-2">
                                        @else
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg"
                                                class="avatar avatar-sm rounded-circle me-2">
                                        @endif
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-xs">{{ $d->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a wire:click="getID({{ $d->id }})"
                                    class="btn btn-icon btn-5 bg-gradient-warning">
                                    <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                </a>
                                <button class="btn bg-gradient-danger" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                </button>
                                @if ($d->status == '1')
                                    <button onclick="showButton({{ $d->id }})"
                                        class="btn btn-icon btn-5 bg-gradient-primary" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                    </button>
                                @else
                                    <button onclick="showButton({{ $d->id }})" class="btn btn-outline-primary"
                                        type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-eye-slash"></i></span>
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

    <script>

        window.addEventListener('tambahKategori', event => {
            $('#tambahKategori').modal('hide')
        })
    </script>
</div>
