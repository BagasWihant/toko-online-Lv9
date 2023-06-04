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
                                        <input required type="text" class="form-control" placeholder="Meta Keyword"
                                            aria-label="Meta Keyword" name="meta_keyword">
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
                                <input required class="form-check-input" type="checkbox" id="status" name="status"
                                    checked="">
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

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Completion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Spotify</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$2,500</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">working</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">60%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-invision.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Invision</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$5,000</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-success"></i>
                            <span class="text-dark text-xs">done</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">100%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Jira</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$3,400</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-danger"></i>
                            <span class="text-dark text-xs">canceled</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">30%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="30"
                                        aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-slack.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Slack</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$1,000</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-danger"></i>
                            <span class="text-dark text-xs">canceled</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">0%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-webdev.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Webdev</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$14,000</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">working</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">80%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-xd.svg"
                                    class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs">Adobe XD</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">$2,300</p>
                    </td>
                    <td>
                        <span class="badge badge-dot me-4">
                            <i class="bg-success"></i>
                            <span class="text-dark text-xs">done</span>
                        </span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-xs">100%</span>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<script>
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
</script>
