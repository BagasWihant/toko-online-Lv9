<div class="container-fluid">
    <h4 class="m-3 text-gradient-primary text-primary">Informasi Pengguna</h4>
    <div class="card">
        @if ($editMode)
            @if ($data)
                <form wire:submit.prevent='save_update(Object.fromEntries(new FormData($event.target)))'>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Nama Lengkap</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        wire:model="nama_lengkap" placeholder="Nama Lengkap">
                                </div>
                                @error('nama_lengkap')
                                    <span class="text-danger"
                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>No. Telp</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        wire:model="no_telp" placeholder="No. Telp">
                                </div>
                                @error('no_telp')
                                    <span class="text-danger"
                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Provinsi</label>
                                <var class="d-none" id="prov_val">{{ $prov }}</var>
                                <div class="input-group">
                                    <select id="provinsi" class="form-control" wire:ignore wire:model='prov'
                                        onchange="loadkab()">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Kabupaten</label>
                                <var class="d-none" id="kab_val">{{ $kab }}</var>
                                <div class="input-group">
                                    <select id="kab" class="form-control" wire:ignore wire:model='kab'
                                        onchange="loadkec()">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Kecamatan</label>
                                <var class="d-none" id="kec_val">{{ $kec }}</var>
                                <div class="input-group">
                                    <select id="kec" class="form-control" wire:ignore wire:model='kec'
                                        onchange="loadkel()">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Kelurahan</label>
                                <var class="d-none" id="kel_val">{{ $kel }}</var>
                                <div class="input-group">
                                    <select id="kel" class="form-control" wire:ignore wire:model='kel'
                                        onchange="loadtext()">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="my-2">
                            <label>Alamat Lengkap</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" wire:model="alamat"
                                    placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name='prov_text' id="prov_text">
                        <input type="hidden" name='kab_text' id="kab_text">
                        <input type="hidden" name='kec_text' id="kec_text">
                        <input type="hidden" name='kel_text' id="kel_text">

                        <div class="text-center">
                            <button class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                Simpan perubahan
                            </button>
                        </div>
                    </div>
                </form>
                <button wire:click='kembali' class="btn btn-round bg-gradient-danger btn-lg w-100 mt-4 mb-0">
                    batalkan perubahan
                </button>
            @else
                <form wire:submit.prevent='save_add(Object.fromEntries(new FormData($event.target)))'>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Nama Lengkap</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        wire:model="nama_lengkap" placeholder="Nama Lengkap">
                                </div>
                                @error('nama_lengkap')
                                    <span class="text-danger"
                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>No. Telp</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        wire:model="no_telp" placeholder="No. Telp">
                                </div>
                                @error('no_telp')
                                    <span class="text-danger"
                                        style="font-size:0.7rem !important;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Provinsi</label>
                                <var class="d-none" id="prov_val">{{ $prov }}</var>
                                <div class="input-group">
                                    <select id="provinsi" class="form-control" wire:ignore wire:model='prov'
                                        onchange="loadkab()">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Kabupaten</label>
                                <var class="d-none" id="kab_val">{{ $kab }}</var>
                                <div class="input-group">
                                    <select id="kab" class="form-control" wire:ignore wire:model='kab'
                                        onchange="loadkec()">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-6">
                                <label>Kecamatan</label>
                                <var class="d-none" id="kec_val">{{ $kec }}</var>
                                <div class="input-group">
                                    <select id="kec" class="form-control" wire:ignore wire:model='kec'
                                        onchange="loadkel()">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Kelurahan</label>
                                <var class="d-none" id="kel_val">{{ $kel }}</var>
                                <div class="input-group">
                                    <select id="kel" class="form-control" wire:ignore wire:model='kel'
                                        onchange="loadtext()">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="my-2">
                            <label>Alamat Lengkap</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" wire:model="alamat"
                                    placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                        <input type="text" class="d-none" name='prov_text' id="prov_text">
                        <input type="text" class="d-none" name='kab_text' id="kab_text">
                        <input type="text" class="d-none" name='kec_text' id="kec_text">
                        <input type="text" class="d-none" name='kel_text' id="kel_text">

                        <div class="text-center">
                            <button class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                Simpan perubahan
                            </button>
                        </div>
                    </div>
                </form>
                <button wire:click='kembali' class="btn btn-round bg-gradient-danger btn-lg w-100 mt-4 mb-0">
                    batalkan perubahan
                </button>
            @endif
        @else
            @if ($data)
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td class="w-40 font-weight-bolder">Nama Lengkap</td>
                                <td class="">:</td>
                                <td class="w-60 word-wrap-anywhere px-1">{{ $data->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">No. Telp</td>
                                <td>:</td>
                                <td>{{ $data->no_telp }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">E-mail</td>
                                <td>:</td>
                                <td>{{ $data->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Alamat Lengkap</td>
                                <td>:</td>
                                <td class="word-wrap-anywhere ">{{ $data->fulltext_alamat }}</td>
                            </tr>
                        </table>
                    </div>

                    <button wire:click='update_data_user_page'
                        class="btn btn-round bg-gradient-secondary btn-lg w-100 mt-4 mb-0">
                        Update Data
                    </button>

                </div>
            @else
                <div class="card-body">

                    <h4 class="text-uppercase text-center text-primary text-gradient-primary">
                        mohon lengkapi data alamat dahulu
                    </h4>

                    <button wire:click='tambah_data_user' class="btn btn-round bg-gradient-primary btn-lg w-100 mt-4">
                        Lengkapi Data alamat
                    </button>
                </div>
            @endif
        @endif
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('load_prov', event => {
            kel_text = '';
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/provinces.json', function(data) {
                data.map(function(data) {
                    $('#provinsi').append(new Option(data.name, data.id))
                })
                prov = $('#prov_val').text()
                $('#provinsi').val(prov)

                prov_text = $('#provinsi option:selected').text();
                $('#prov_text').val(prov_text)
            })

            // LOAD KABUPATEN
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/regencies/' + prov_val.textContent +
                '.json',
                function(data) {
                    data.map(function(data) {
                        $('#kab').append(new Option(data.name, data.id))
                    })
                    kab = $('#kab_val').text()
                    $('#kab').val(kab)

                    kab_text = $('#kab option:selected').text();
                    $('#kab_text').val(kab_text)
                })

            // LOAD KECAMATAN
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/districts/' + kab_val.textContent +
                '.json',
                function(data) {
                    data.map(function(data) {
                        $('#kec').append(new Option(data.name, data.id))
                    })
                    kec = $('#kec_val').text()
                    $('#kec').val(kec)

                    kec_text = $('#kec option:selected').text();
                    $('#kec_text').val(kec_text)
                })

            // LOAD KELURAHAN
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/villages/' + kec_val.textContent +
                '.json',
                function(data) {
                    data.map(function(data) {
                        $('#kel').append(new Option(data.name, data.id))
                    })
                    kel = $('#kel_val').text()
                    $('#kel').val(kel)

                    kel_text = $('#kel option:selected').text();
                    $('#kel_text').val(kel_text)
                })
        })
        window.addEventListener('load_prov_tambah', event => {
            console.log('KAJSD');
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/provinces.json', function(data) {
                data.map(function(data) {
                    $('#provinsi').append(new Option(data.name, data.id))
                })
            })
        })
        function loadkab() {
            prov = $('#provinsi').val();
            $('#kab').find('option:not(:first)').remove();
            $('#kec').find('option:not(:first)').remove();
            $('#kel').find('option:not(:first)').remove();
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/regencies/' + prov + '.json', function(data) {
                data.map(function(data) {
                    $('#kab').append(new Option(data.name, data.id))
                })
            })
        }

        function loadkec() {
            kab = $('#kab').val();
            $('#kec').find('option:not(:first)').remove();
            $('#kel').find('option:not(:first)').remove();
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/districts/' + kab + '.json', function(data) {
                data.map(function(data) {
                    $('#kec').append(new Option(data.name, data.id))
                })
            })



        }

        function loadkel() {
            kec = $('#kec').val();
            $('#kel').find('option:not(:first)').remove();
            $.get('https://bagaswihant.github.io/api-wilayah-indonesia/api/villages/' + kec + '.json', function(data) {
                data.map(function(data) {
                    $('#kel').append(new Option(data.name, data.id))
                })
            })

        }

        function loadtext() {
            console.log('AKSJHD');
            prov_text = $('#provinsi option:selected').text();
            $('#prov_text').val(prov_text)

            kab_text = $('#kab option:selected').text();
            $('#kab_text').val(kab_text)

            kec_text = $('#kec option:selected').text();
            $('#kec_text').val(kec_text)

            kel_text = $('#kel option:selected').text();
            $('#kel_text').val(kel_text)
        }
    </script>
@endpush
