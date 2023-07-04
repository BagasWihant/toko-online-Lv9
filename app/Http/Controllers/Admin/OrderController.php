<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function index()
    {
        $data = array('title' => 'Order');
        return view('admin.order.index', $data);
    }
}
