<?php

namespace App\Http\Livewire\Admin\Produk;

use App\Models\Category;
use App\Models\GambarProduk;
use App\Models\Product;
use App\Models\ProdukWarna;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $errorValidasi = '',$produk_id, $name, $brand, $slug, $status, $deskripsi, $image = [], $oldImage = null, $kategori_id,
        $kondisiModal = 'tambah', $produk, $trending, $harga_jual, $jumlah, $warna = [];
    public $iteration = 0, $totalWarna = 1, $color,$colorID, $qty; // untuk id upload ben bar upload ke reset

    // image
    public $productWarna;




    protected $listeners = ['terhapus' => '$refresh'];
    protected $rules = [
        'name' => 'required|min:3|string|unique:products',
        'slug' => 'required|string',
        'kategori_id' => 'required',
        'deskripsi' => 'required|string',
        'harga_jual' => 'required|integer',
        'image' => 'required',
        'color' => 'required',
    ];
    protected $messages = [
        'color.required' => 'Mohon isi Warna / Tipe & jumlah produk',
        'image.required' => 'Mohon isi Gambar produk',
    ];
    public function clear()
    {
        $this->iteration = 0;
        $this->errorValidasi = '';
        $this->produk_id = '';
        $this->name = '';
        $this->brand = '';
        $this->slug = '';
        $this->status = '';
        $this->deskripsi = '';
        $this->image = null;
        $this->oldImage = null;
        $this->kategori_id = '';
        $this->produk = '';
        $this->trending = '';
        $this->harga_jual = '';
        $this->jumlah = '';
        $this->kondisiModal = 'tambah';
        $this->warna = [];
        $this->productWarna = null;
        $this->color = [];
        $this->colorID = [];
        $this->qty = [];
    }

    public function hapusGambar($id)
    {
        $gambar = GambarProduk::findOrFail($id);
        if (File::exists(public_path($gambar->gambar))) {
            File::delete(public_path($gambar->gambar));
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
        $this->trending = $this->produk->trending;
        $this->harga_jual = $this->produk->harga_jual;
        $this->jumlah = $this->produk->jumlah;
        $img = $this->produk->productImage;
        $this->oldImage = $img;

        $this->productWarna = $this->produk->productWarna;
        foreach ($this->productWarna as $k => $v) {
            $this->qty[$k] = $v->qty;
            $this->color[$k] = $v->warna;
            $this->colorID[$k] = $v->id;
        }
    }

    public function tambahProduk()
    {
        $jumlahTotal = 0;
        if ($this->color) {
            foreach ($this->color as $k => $v) {
                $jumlahTotal = $jumlahTotal + $this->qty[$k];
            }
        }
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->errorValidasi = $e->getMessage();
        }

        $category = Category::findOrFail($this->kategori_id);
        $product = $category->product()->create([
            'name' => $this->name,
            'brand' => $this->brand,
            'slug' => $this->slug,
            'kategori_id' => $this->kategori_id,
            'deskripsi' => $this->deskripsi,
            'harga_jual' => $this->harga_jual,
            'jumlah' => $jumlahTotal,
            'trending' => $this->trending ? '1' : '0',
            'status' => $this->status ? '1' : '0',
        ]);
        // INSERT WARNA
        $jumlahTotal = 0;
        foreach ($this->color as $k => $v) {
            $product->productWarna()->create([
                'produk_id' => $product->id,
                'warna' => $this->color[$k],
                'qty' => $this->qty[$k],
            ]);
            $jumlahTotal = $jumlahTotal + $this->qty[$k];
        }
        // INSERT GAMBAR
        if ($this->image != null) {
            $this->validate([
                'image.*' => 'image|max:7017',
            ]);
            foreach ($this->image as $key => $img) {
                $image = $img->storePublicly('upload/produk', 'real_public');
                // $image = $img->store('public/upload/produk/'); //path => storage/app/public
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
                if (File::exists(public_path($gambar->gambar))) {
                    File::delete(public_path($gambar->gambar));
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
        try {
            $this->validate([
                'name' => 'required|min:3|string',
                'slug' => 'required|string',
                'deskripsi' => 'required|string',
                'harga_jual' => 'required|integer',
                'image' => 'nullable',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->errorValidasi = $e->getMessage();
        }


        $jumlahTotal = 0;
        $produk = Product::where('id', $this->produk_id)->first();
        foreach ($this->color as $k => $v) {

            if(!isset($this->colorID[$k])){
                $this->colorID[$k] = 00; //
            }

            $cekWarna = ProdukWarna::where('id',$this->colorID[$k]);
            if($cekWarna->exists()){
                $cekWarna =$cekWarna->first();
                // jika ada update jumlah saja
                $cekWarna->warna = $this->color[$k];
                $cekWarna->qty = $this->qty[$k];
                $cekWarna->update();

            }else{
                $produk->productWarna()->create([
                    'produk_id' => $this->produk_id,
                    'warna' => $this->color[$k],
                    'qty' => $this->qty[$k],
                ]);
            }

            $jumlahTotal = $jumlahTotal + $this->qty[$k];
        }


        $this->produk->name = $this->name;
        $this->produk->kategori_id = $this->kategori_id;
        $this->produk->brand = $this->brand;
        $this->produk->slug = $this->slug;
        $this->produk->deskripsi = $this->deskripsi;
        $this->produk->harga_jual = $this->harga_jual;
        $this->produk->jumlah = $jumlahTotal;
        $this->produk->trending = $this->trending ? '1' : '0';
        $this->produk->status = $this->status ? '1' : '0';
        $this->produk->update();
        if ($this->image != null) {
            $this->validate([
                'image.*' => 'image|max:7017',
            ]);
            foreach ($this->image as $key => $img) {
                $image = $img->storePublicly('upload/produk', 'real_public');
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
        $this->produk->status = '1';
        $this->produk->update();
        $this->clear();
    }

    public function hide($id)
    {
        $this->getID($id);
        $this->produk->status = '0';
        $this->produk->update();
        $this->clear();
    }

    public function tambahWarna($totalWarna)
    {
        $totalWarna = $totalWarna + 1;
        $this->totalWarna = $totalWarna;

        array_push($this->warna, $totalWarna);
    }

    public function hapusWarna($id){
        // SET KOSONG ARRAY
        $this->qty = $this->color = $this->colorID =[];

        ProdukWarna::find($id)->delete();
        $this->productWarna = ProdukWarna::where('produk_id',$this->produk_id)->get();
        foreach ($this->productWarna as $k => $v) {
            $this->qty[$k] = $v->qty;
            $this->color[$k] = $v->warna;
            $this->colorID[$k] = $v->id;
        }
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
