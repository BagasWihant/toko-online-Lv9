<?php

namespace App\Http\Livewire\User;

use App\Models\Keranjang;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class KeranjangCount extends Component
{
    public $jml;
    protected $listeners =['masukKeranjang'=>'render'];

    public function cek()
    {
        if (Auth::check()) {
            return $this->jml = Keranjang::where('user_id', Auth::id())->count();
        } else {
            return $this->jml = 0;
        }
    }

    public function render()
    {
        $this->cek();
        return view('livewire.user.keranjang-count',['jml'=>$this->jml]);
    }
}
