<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
      protected $fillable = [
        'nom',
        'description',
        'prix',
        'size',
        'image',
        'stock',
    ];
  public function orders()
{
    return $this->belongsToMany(Order::class)
                ->withPivot('quantite')
                ->withTimestamps();
}
}

