<?php

namespace App\Http\Livewire\User\Market;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist as WishlistModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Wishlist extends Component
{
    use LivewireAlert;

    public function hapusWishlist($id)
    {
        WishlistModel::where('id', $id)->delete();
        $this->alert('success', 'Produk dihapus dari Wishlist', [
            'position' => 'center',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
            'customClass' => [
                'popup' => 'colored-toast'
            ]
        ]);
        $this->emit('masukWishlist');

    }
    public function render()
    {
        $data = WishlistModel::where('user_id',Auth::id())->get();

        return view('livewire.user.market.wishlist', ['data' => $data]);
    }
}
