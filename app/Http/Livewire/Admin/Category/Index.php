<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $category_id, $name, $slug, $status = 1, $description, $image, $oldImage, $meta_title, $meta_keyword, $meta_description, $kondisi, $category;
    public $iteration =0; // untuk id upload ben bar upload ke reset

    protected $rules = [
        'name' => 'required|min:3|string|unique:categories',
        'slug' => 'required|string',
        'description' => 'required|string',
        'meta_title' => 'required|string',
        'meta_keyword' => 'required|string',
        'meta_description' => 'required|string',
    ];
    // syntax bawaan go live cek on keyup
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function clearForm()
    {
        $this->image = null;
        $this->iteration++;
        $this->oldImage = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->meta_description = '';
        $this->meta_keyword = '';
        $this->meta_title = '';
        $this->kondisi = '';
    }

    public function getID($id){
        $this->category = Category::where('id',$id)->first();

        $this->kondisi = 'update';
        $this->category_id = $this->category->id;
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
        $this->description = $this->category->description;
        $this->oldImage = $this->category->image;
        $this->meta_title = $this->category->meta_title;
        $this->meta_keyword = $this->category->meta_keyword;
        $this->meta_description = $this->category->meta_description;
    }

    public function tambahKategori(){

        $this->validate();
        $category = new Category;
        $category->name = $this->name;
        $category->slug = Str::slug($this->slug);
        $category->description = $this->description;
        $category->meta_title = $this->meta_title;
        $category->meta_keyword = $this->meta_keyword;
        $category->meta_description = $this->meta_description;
        $category->status = $this->status == true ? '1' : '0';

        if($this->image != null){
            $this->validate([
                'image' => 'image|max:7017',
            ]);
            $image = $this->image->store('public/upload/category/'); //path => storage/app/public
            $category->image = $image;
        }
        $category->save();
        $this->iteration++;
        $this->clearForm();
        $this->dispatchBrowserEvent('tambahKategori');
    }

    public function hapusKategori(){

        $this->category->delete();
        $this->clearForm();
        $this->dispatchBrowserEvent('hapusKategori');

    }


    public function updateKategori(){
        $this->validate([
            'name' => 'required|min:3|string|',
            'slug' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ]);

        // $category = Category::find($this->category_id);

        $this->category->name = $this->name;
        $this->category->slug = Str::slug($this->slug);
        $this->category->description = $this->description;
        $this->category->meta_title = $this->meta_title;
        $this->category->meta_keyword = $this->meta_keyword;
        $this->category->meta_description = $this->meta_description;

        if($this->image != null){
            $this->validate([
                'image' => 'image|max:7017',
            ]);
            $image = $this->image->store('public/upload/category/'); //path => storage/app/public
            $this->category->image = $image;
        }
        
        $this->category->update();
        $this->iteration++;
        $this->clearForm();

        $this->dispatchBrowserEvent('updateKategori');

    }

    public function hide($id){
        $this->getID($id);
        $this->category->status = '0';
        $this->category->update();
    }
    public function show($id){
        $this->getID($id);
        $this->category->status = '1';
        $this->category->update();
    }

    public function render()
    {
        $data = Category::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.category.index',['data'=>$data]);
    }
}
