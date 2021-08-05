<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['name', 'description', 'price', 'stock', 'type', 'bumpprice', 'tags', 'weight'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function cart()
    {
        return $this->hasMany(Chart::class);
    }
}
