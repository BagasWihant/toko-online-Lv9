<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $orderID,$dataOrder,$statusPage='-';

    public function kembaliSemula(){
        $this->statusPage = '-';
    }

    public function detail($id){
        $this->statusPage = 'detail';
        $this->dataOrder = Order::find($id);
    }

    public function render()
    {
        $data = Order::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.order.index',compact('data'));
    }
}
