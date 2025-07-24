<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $guarded = ['id'];

    public function clientProducts()
    {
        return $this->hasMany(ClientProduct::class);
    }
 
    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function commandToday()
    {
       return $this->commands()
        ->whereDate('created_at', Carbon::today())->first();
    }
}
