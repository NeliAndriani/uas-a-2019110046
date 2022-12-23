<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $table = 'menus';
    protected $fillable = ['id','nama','rekomendasi', 'harga', 'image'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_menu')->withPivot('quantity');
    }
}
