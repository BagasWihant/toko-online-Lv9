<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = Category::all();
        return view('livewire.admin.category.index',['data'=>$data]);
    }
}
