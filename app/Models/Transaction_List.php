<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_List extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['transaction_id', 'product_id', 'name', 'qty', 'price', 'message'];

    protected $table = 'transaction_list';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
