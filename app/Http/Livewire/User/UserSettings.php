<?php

namespace App\Http\Livewire\User;


use Livewire\Component;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserSettings extends Component
{
    use LivewireAlert;
    public $editMode = false, $dataUser;
    public $nama_lengkap, $no_telp, $prov, $kab, $kec, $kel, $alamat;


    public function update_data_user_page()
    {
        $this->editMode = true;
        $this->dispatchBrowserEvent('load_prov');

        $user = $this->dataUser;
        $this->nama_lengkap = $user->nama_lengkap;
        $this->no_telp = $user->no_telp;
        $this->prov = $user->provinsi;
        $this->kab = $user->kabupaten;
        $this->kec = $user->kecamatan;
        $this->kel = $user->kelurahan;
        $this->alamat = $user->alamat;
    }

    public function save_update($formData)
    {
        $this->dataUser->nama_lengkap = $this->nama_lengkap;
        $this->dataUser->no_telp = $this->no_telp;
        $this->dataUser->provinsi = $this->prov;
        $this->dataUser->kabupaten = $this->kab;
        $this->dataUser->kecamatan = $this->kec;
        $this->dataUser->kelurahan = $this->kel;
        $this->dataUser->alamat = $this->alamat;

        $full_alamat = strtoupper("$this->alamat, $formData[kel_text], $formData[kec_text], $formData[kab_text], $formData[prov_text]");
        $this->dataUser->fulltext_alamat = $full_alamat;
        $this->dataUser->save();

        $this->alert('success', 'Sukses Perbarui Alamat', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);

        $this->editMode = false;
    }

    public function tambah_data_user()
    {
        $this->editMode = true;
        $this->dispatchBrowserEvent('load_prov_tambah');
    }

    public function save_add($formData)
    {

        $full_alamat = strtoupper("$this->alamat, $formData[kel_text], $formData[kec_text], $formData[kab_text], $formData[prov_text]");
        UserDetail::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $this->nama_lengkap,
            'no_telp' => $this->no_telp,
            'provinsi' => $this->prov,
            'kabupaten' => $this->kab,
            'kecamatan' => $this->kec,
            'kelurahan' => $this->kel,
            'alamat' => $this->alamat,
            'fulltext_alamat' => $full_alamat,
        ]);

        $this->alert('success', 'Sukses Menambahkan Alamat', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);

        $this->editMode = false;
    }

    public function kembali()
    {
        $this->editMode = false;
    }

    public function render()
    {
        $dataUser = UserDetail::where('user_id', Auth::id());
        $data = [];
        if ($dataUser->exists()) {
            $data = $dataUser->first();
            $this->dataUser = $data;
        }
        return view('livewire.user.user-settings', compact('data'));
    }
}
