<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;
    protected $listeners = [
        'deleteAksi'
    ];

    public $iteration = 0; // untuk id upload ben bar upload ke reset

    public $slider_id, $title, $deskripsi, $status = 1, $kondisiModal = 'tambah';

    public $image, $oldImage, $slider;

    function clearForm()
    {
        $this->title = '';
        $this->deskripsi = '';
        $this->status = 1;
        $this->kondisiModal = 'tambah';
        $this->image = null;
        $this->oldImage = null;
        $this->slider = null;
    }

    function getID($id, $del = null)
    {
        $this->slider = Slider::where('id', $id)->first();
        $this->slider_id = $this->slider->id;
        $this->title = $this->slider->title;
        $this->deskripsi = $this->slider->deskripsi;
        $this->status = $this->slider->status;
        $this->kondisiModal = 'update';
        $this->oldImage = $this->slider->image;
        $this->iteration = 0;
        if ($del == 'delete') {
            $this->alert('warning', 'Apakah anda yakin menghapus slider ini?', [
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'timerProgressBar' => true,
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'onConfirmed' => 'deleteAksi',
                'confirmButtonText' => 'Ya',
                'cancelButtonText' => 'Tidak jadi',
            ]);
        }
    }
    public function deleteAksi()
    {
        if (File::exists(public_path($this->slider->image))) {
            File::delete(public_path($this->slider->image));
        }
        $this->slider->delete();
        $this->alert('success', 'Sukses', [
            'position' => 'top-end',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Slider berhasil dihapus',
            'customClass' =>[
                'popup'=> 'colored-toast'
            ]
        ]);
    }

    function tambahSlider()
    {
        $this->validate([
            'image' => 'nullable|image',
            'title' => 'required',
        ]);
        $image = '';
        if ($this->image != null) {
            $image = $this->image->storePublicly('upload/slider', 'real_public');
        }
        Slider::create([
            'title' => $this->title,
            'deskripsi' => $this->deskripsi,
            'image' => $image,
            'status' => $this->status == true ? 1 : 0,
        ]);
        $this->dispatchBrowserEvent('modalhide');
        $this->alert('success', 'Sukses', [
            'position' => 'top-end',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Slider Tersimpan',
            'customClass' =>[
                'popup'=> 'colored-toast'
            ]
        ]);
        $this->iteration++;

        $this->clearForm();
    }

    function updateSlider()
    {
        $this->validate([
            'image' => 'nullable|image',
            'title' => 'required',
        ]);
        $slider = Slider::where('id', $this->slider_id)->first();
        $slider->title = $this->title;
        $slider->deskripsi = $this->deskripsi;
        if ($this->image != null) {
            if (File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }
            $image = $this->image->store('public/upload/slider/');
            $slider->image = $image;
        }
        $slider->status = $this->status == true ? 1 : 0;
        $slider->update();
        $this->iteration++;
        $this->clearForm();

        $this->dispatchBrowserEvent('modalhide');
        $this->alert('success', 'Sukses', [
            'position' => 'top-end',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Slider Terupdate',
            'customClass' =>[
                'popup'=> 'colored-toast'
            ]
        ]);
    }


    public function hide($id)
    {
        $this->getID($id);
        $this->slider->status = '0';
        $this->slider->update();
    }
    public function show($id)
    {
        $this->getID($id);
        $this->slider->status = '1';
        $this->slider->update();
    }

    public function render()
    {
        $data = Slider::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.slider.index', compact('data'));
    }
}
