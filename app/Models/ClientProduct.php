<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['client_id', 'product_id', 'price'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
