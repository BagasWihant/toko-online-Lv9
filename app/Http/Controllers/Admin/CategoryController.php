<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $data = array('title' => 'Category');
        return view('admin.category.main', $data);
    }
    public function storeAdd(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;

            $file->move('upload/category/',$fileName);
            $category->image = $fileName;
        }
        $category->status = $request->status == 'on' ? '1' : '0';
        $category->save();

        return json_encode(['success'=>true,'pesan'=>'Berhasil Tambah Data']);
        // return redirect('admin/category')->with('success','true');
    }
}