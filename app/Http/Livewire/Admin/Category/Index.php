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

    public $category_id;
    public $name;
    public $slug;
    public $status;
    public $description;
    public $image;
    public $meta_title;
    public $meta_keyword;
    public $iteration =0;
    public $meta_description;

    protected $rules = [
        'name' => 'required|min:3|string',
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
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->meta_description = '';
        $this->meta_keyword = '';
        $this->meta_title = '';
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
        $category->status = $this->status == 'on' ? '1' : '0';

        if($this->image != null){
            $this->validate([
                'image' => 'image|max:7017',
            ]);
            $image = $this->image->store('public/upload/category/'); //path => storage/app/public
            $category->image = $image;
        }
        $category->save();
        $this->image = null;
        $this->iteration++;
        $this->clearForm();
        // $this->dispatchBrowserEvent('name-updated');
        $this->dispatchBrowserEvent('tambahKategori');
    }

    public function getID($id){
        $category = Category::where('id',$id)->first();

        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->image = $category->image;
        $this->meta_title = $category->meta_title;
        $this->meta_keyword = $category->meta_keyword;
        $this->meta_description = $category->meta_description;

    }

    public function formUpdateKategori(){
        $this->validate();

        $category = Category::find($this->category_id);

        $category->name = $this->name;
        $category->slug = Str::slug($this->slug);
        $category->description = $this->description;
        $category->meta_title = $this->meta_title;
        $category->meta_keyword = $this->meta_keyword;
        $category->meta_description = $this->meta_description;

        if($request->hasFile('image')){
            $path = 'upload/category/'. $category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;

            $file->move('upload/category/',$fileName);
            $category->image = $fileName;
        }
        $category->update();
    }

    public function render()
    {
        $data = Category::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.category.index',['data'=>$data]);
    }
}
