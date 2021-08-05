<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['user_id', 'status', 'amount', 'order_id', 'shipment', 'va', 'address', 'contact'];

    public function list()
    {
        return $this->hasMany(Transaction_List::class, 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
