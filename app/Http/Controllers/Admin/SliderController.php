<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $data = array('title' => 'Slider');
        return view('admin.slider.slider', $data);
    }

}
