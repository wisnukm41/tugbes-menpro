<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use Uuids;

    protected $table = 'reviews';

    protected $fillable = ['user_id', 'product_id', 'description', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
