<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = Category::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.category.index',['data'=>$data]);
    }
}
