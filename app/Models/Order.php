<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class,'user_id','user_id');
    }
}
