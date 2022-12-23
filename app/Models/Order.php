<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'order_menu')->withPivot('quantity');
    }
}
