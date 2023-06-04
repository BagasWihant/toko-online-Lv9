<div>
    <div class="col-lg-2 col-md-3 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">

        <button class="btn btn-icon btn-3 bg-gradient-info" type="button" data-bs-toggle="modal"
            data-bs-target="#tambahKategori">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            <span class="btn-inner--text">Tambah Kategori</span>
        </button>
    </div>

    <!-- Modal tambah kategori-->
    <div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="tambahKategori"
        aria-hidden="true">
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
                            <form role="form text-left" id="formTambahKategori" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nama</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control" placeholder="Nama"
                                                aria-label="Nama" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Slug</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control" placeholder="Slug"
                                                aria-label="Slug" name="slug">
                                        </div>
                                    </div>
                                </div>
                                <label>Deskripsi</label>
                                <div class="input-group mb-3">
                                    <textarea required type="text" class="form-control" placeholder="Deskripsi" aria-label="Deskripsi"
                                        name="description"></textarea>
                                </div>
                                <label>Image</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Meta Title</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control" placeholder="Meta Title"
                                                aria-label="Meta Title" name="meta_title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Meta Keyword</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control"
                                                placeholder="Meta Keyword" aria-label="Meta Keyword"
                                                name="meta_keyword">
                                        </div>
                                    </div>
                                </div>
                                <label>Meta Deskripsi</label>
                                <div class="input-group mb-3">
                                    <textarea required type="text" class="form-control" placeholder="Meta Deskripsi" aria-label="Meta Deskripsi"
                                        name="meta_description"></textarea>
                                </div>
                                <label class="form-check-label" for="status">Remember me</label>
                                <div class="form-check form-switch">
                                    <input required class="form-check-input" type="checkbox" id="status"
                                        name="status" checked="">
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

    <!-- Modal EDIT kategori-->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog" aria-labelledby="editKategoriModal"
        aria-hidden="true">
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
                            <h5 class="font-weight-bolder text-center text-warning text-gradient">Edit Kategori</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" wire:submit.prevent="$refresh" method="POST" id="formUpdateKategori"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nama</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control" placeholder="Nama"
                                                aria-label="Nama" name="name" id="name">
                                        </div>
                                    </div>
                                    <input required type="hidden" name='id' id="id">
                                    <div class="col-md-6">
                                        <label>Slug</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control" placeholder="Slug"
                                                aria-label="Slug" name="slug" id="slug">
                                        </div>
                                    </div>
                                </div>
                                <label>Deskripsi</label>
                                <div class="input-group mb-3">
                                    <textarea required type="text" class="form-control" id="description" placeholder="Deskripsi"
                                        aria-label="Deskripsi" name="description"></textarea>
                                </div>
                                <label>Image</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Meta Title</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control"
                                                placeholder="Meta Title" aria-label="Meta Title" name="meta_title"
                                                id="meta_title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Meta Keyword</label>
                                        <div class="input-group mb-3">
                                            <input required type="text" class="form-control"
                                                placeholder="Meta Keyword" aria-label="Meta Keyword"
                                                name="meta_keyword" id="meta_keyword">
                                        </div>
                                    </div>
                                </div>
                                <label>Meta Deskripsi</label>
                                <div class="input-group mb-3">
                                    <textarea required type="text" class="form-control" placeholder="Meta Deskripsi" aria-label="Meta Deskripsi"
                                        name="meta_description" id="meta_description"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Update</button>
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
                                            <img src="{{ url('upload/category/' . $d->image) }}"
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
                                <button onclick="editButton({{ $d->id }})"
                                    class="btn btn-icon btn-5 bg-gradient-warning" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                </button>
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
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#formTambahKategori").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            url: "{{ url('admin/category') }}",
            success: function(data) {
                if (data.success) {
                    $('#tambahKategori').modal('hide')
                    $('#formTambahKategori').trigger('reset')
                }
            }
        });
    });

    $("#formUpdateKategori").on('submit', function(e) {
        e.preventDefault();
        id = $('#id').val()
        url = './category/' + id + '/edit'
        console.log(new FormData(this));
        $.ajax({
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            url: url,
            success: function(data) {
                if (data.success) {
                    $('#editKategoriModal').modal('hide')
                    $('#formUpdateKategori').trigger('reset')

                }
            }
        });
    });

    function editButton(id) {
        url = './category/' + id + '/edit'
        $.get(url, function(res) {
            console.log(res);

            $('#editKategoriModal').modal('show')
            $('#formUpdateKategori #id').val(res.id)
            $('#formUpdateKategori #name').val(res.name)
            $('#formUpdateKategori #slug').val(res.slug)
            $('#formUpdateKategori #meta_keyword').val(res.meta_keyword)
            $('#formUpdateKategori #meta_title').val(res.meta_title)
            $('#formUpdateKategori #description').val(res.description)
            $('#formUpdateKategori #meta_description').val(res.meta_description)
            $('#formUpdateKategori').prop('action', url)
        })
    }

    function showButton(id) {
        url = './category/' + id + '/showHide'
        $.get(url, function(res) {
            console.log(res);

            $('#editKategoriModal').modal('show')
            $('#nameEdit').val(res.name)
            $('#slugEdit').val(res.slug)
            $('#meta_keywordEdit').val(res.meta_keyword)
            $('#meta_titleEdit').val(res.meta_title)
            $('#descriptionEdit').val(res.description)
            $('#meta_descriptionEdit').val(res.meta_description)
            res.status === '1' ? $('#statusEdit').prop('checked', true) : $('#statusEdit').prop('checked',
                false)
        })
    }
</script>
