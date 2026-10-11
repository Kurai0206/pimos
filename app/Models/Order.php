<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'total', 'status'];

    //Relación de muchos a muchos con product
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('cantidad', 'precio_unitario')->withTimestamps();
    }
    //Relación inversa uno a muchos con user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
