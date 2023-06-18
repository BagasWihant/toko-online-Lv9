<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //

    public function index(){
        $data = array('title' => 'Category');
        return view('admin.category.main', $data);
    }

    public function getDetail(Category $id){
        return $id;
    }
    public function edit(CategoryRequest $request, $data){
        $validatedData = $request->validated();

        $category = Category::findOrFail($data);

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

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
        return json_encode(['success'=>true,'pesan'=>'Berhasil Update Data']);
    }

    public function storeAdd(CategoryRequest $request){
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;

            $file->storePublicly('upload', $fileName, 's3');
            // $file->move('upload/category/',$fileName);
            $category->image = $fileName;
        }
        $category->status = $request->status == 'on' ? '1' : '0';
        $category->save();

        return json_encode(['success'=>true,'pesan'=>'Berhasil Tambah Data']);
        // return redirect('admin/category')->with('success','true');
    }
}
