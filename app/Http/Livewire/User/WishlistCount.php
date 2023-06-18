<?php

namespace App\Http\Livewire\User;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $jml;
    protected $listeners = ['masukWishlist'=>'render'];
    public function cek()
    {
        if (Auth::check()) {
            return $this->jml = Wishlist::where('user_id', Auth::id())->count();
        } else {
            return $this->jml = 0;
        }
    }

    public function render()
    {
        $this->cek();
        return view('livewire.user.wishlist-count',['jml' => $this->jml]);
    }
}
