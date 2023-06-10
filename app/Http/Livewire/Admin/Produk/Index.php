<?php

namespace App\Http\Livewire\Admin\Produk;

use App\Models\Category;
use App\Models\GambarProduk;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $produk_id, $name, $brand, $slug, $status, $deskripsi, $image = [], $oldImage = null, $kategori_id, $editmode = false,
        $meta_title, $meta_keyword, $meta_deskripsi, $kondisiModal = 'tambah', $produk, $trending, $harga_asli, $harga_jual, $jumlah, $update;
    public $iteration = 0; // untuk id upload ben bar upload ke reset

    protected $listeners = ['terhapus' => '$refresh'];
    protected $rules = [
        'name' => 'required|min:3|string|unique:categories',
        'slug' => 'required|string',
        'deskripsi' => 'required|string',
        'meta_title' => 'required|string',
        'meta_keyword' => 'required|string',
        'meta_deskripsi' => 'required|string',
        'harga_jual' => 'required',
        'harga_asli' => 'required',
        'image' => 'nullable',
    ];
    public function clear()
    {
        $this->iteration++;
        $this->produk_id = '';
        $this->name = '';
        $this->brand = '';
        $this->slug = '';
        $this->status = '';
        $this->deskripsi = '';
        $this->image = null;
        $this->oldImage = null;
        $this->kategori_id = '';
        $this->meta_title = '';
        $this->meta_keyword = '';
        $this->meta_deskripsi = '';
        $this->produk = '';
        $this->trending = '';
        $this->harga_asli = '';
        $this->harga_jual = '';
        $this->jumlah = '';
        $this->kondisiModal = 'tambah';
        $this->editmode = false;
    }

    public function hapusGambar($id)
    {
        $gambar = GambarProduk::findOrFail($id);
        if (Storage::exists($gambar->gambar)) {
            Storage::delete($gambar->gambar);
        }
        $gambar->delete();
        $this->emit('terhapus');
    }

    public function getID($id)
    {
        $this->produk = Product::where('id', $id)->first();
        $this->kondisiModal = 'update';
        $this->produk_id = $this->produk->id;
        $this->name = $this->produk->name;
        $this->brand = $this->produk->brand;
        $this->slug = $this->produk->slug;
        $this->status = $this->produk->status;
        $this->deskripsi = $this->produk->deskripsi;
        $this->kategori_id = $this->produk->kategori_id;
        $this->meta_title = $this->produk->meta_title;
        $this->meta_keyword = $this->produk->meta_keyword;
        $this->meta_deskripsi = $this->produk->meta_deskripsi;
        $this->trending = $this->produk->trending;
        $this->harga_asli = $this->produk->harga_asli;
        $this->harga_jual = $this->produk->harga_jual;
        $this->jumlah = $this->produk->jumlah;
        $img = $this->produk->productImage;
        $this->oldImage = $img;
        // dd($this->brand);
    }

    public function tambahProduk()
    {
        $this->validate();
        $category = Category::findOrFail($this->kategori_id);
        $product = $category->product()->create([
            'name' => $this->name,
            'brand' => $this->brand,
            'slug' => $this->slug,
            'deskripsi' => $this->deskripsi,
            'harga_asli' => $this->harga_asli,
            'harga_jual' => $this->harga_jual,
            'jumlah' => $this->jumlah,
            'meta_title' => $this->meta_title,
            'meta_keyword' => $this->meta_keyword,
            'meta_deskripsi' => $this->meta_deskripsi,
            'trending' => $this->trending ? '1' : '0',
            'status' => $this->status ? '1' : '0',
        ]);

        if ($this->image != null) {
            $this->validate([
                'image.*' => 'image|max:7017',
            ]);
            foreach ($this->image as $key => $img) {

                $image = $img->store('public/upload/produk/'); //path => storage/app/public
                $product->productImage()->create([
                    'produk_id' => $product->id,
                    'gambar' => $image,
                ]);
            }
        }
        $this->iteration++;
        $this->clear();
        $this->dispatchBrowserEvent('modalhide');
    }

    public function hapusProduk()
    {

        if ($this->produk->productImage) {
            foreach ($this->produk->productImage as $img) {
                $gambar = GambarProduk::findOrFail($img->id);
                if (Storage::exists($gambar->gambar)) {
                    Storage::delete($gambar->gambar);
                }
                $gambar->delete();
            }
        }
        $this->produk->delete();
        $this->clear();
        $this->dispatchBrowserEvent('hapusKategori');
    }

    public function updateProduk()
    {
        $this->validate([
            'name' => 'required|min:3|string',
            'slug' => 'required|string',
            'deskripsi' => 'required|string',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_deskripsi' => 'required|string',
            'harga_jual' => 'required',
            'harga_asli' => 'required',
            'image' => 'nullable',
        ]);
        // dd($this->produk->name);
        $this->produk->name = $this->name;
        $this->produk->brand = $this->brand;
        $this->produk->slug = $this->slug;
        $this->produk->deskripsi = $this->deskripsi;
        $this->produk->harga_asli = $this->harga_asli;
        $this->produk->harga_jual = $this->harga_jual;
        $this->produk->jumlah = $this->jumlah;
        $this->produk->meta_title = $this->meta_title;
        $this->produk->meta_keyword = $this->meta_keyword;
        $this->produk->meta_deskripsi = $this->meta_deskripsi;
        $this->produk->trending = $this->trending ? '1' : '0';
        $this->produk->status = $this->status ? '1' : '0';
        $this->produk->update();
        if ($this->image != null) {
            $this->validate([
                'image.*' => 'image|max:7017',
            ]);
            foreach ($this->image as $key => $img) {

                $image = $img->store('public/upload/produk/'); //path => storage/app/public
                $this->produk->productImage()->create([
                    'produk_id' => $this->produk->id,
                    'gambar' => $image,
                ]);
            }
        }
        $this->iteration++;
        $this->clear();
        $this->dispatchBrowserEvent('modalhide');
    }


    public function show($id)
    {
        $this->getID($id);
        sleep(3);
        $this->produk->status = '1';
        $this->produk->update();
        $this->clear();
    }
    public function hide($id)
    {
        $this->getID($id);
        sleep(3);
        $this->produk->status = '0';
        $this->produk->update();
        $this->clear();
    }

    public function render()
    {
        $data = Product::orderBy('created_at', 'DESC')->paginate(10);
        $kategori = Category::orderBy('created_at', 'DESC')->paginate(10);
        $gambar = '';
        if ($this->produk) {
            $gambar = $this->produk->productImage;
        }
        return view('livewire.admin.produk.index', ['data' => $data, 'kategori' => $kategori, 'gambar' => $gambar]);
    }
}
