<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $table = 'wilayas';

    public $timestamps = false;

    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
