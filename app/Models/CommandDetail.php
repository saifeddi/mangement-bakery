<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandDetail extends Model
{
    protected $guarded = ['id'];

    public function command()
    {
        return $this->belongsTo(Command::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
