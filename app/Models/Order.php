<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       protected $fillable = [
        'nom',
        'prenom',
        'phone',
        'total',
        'wilaya',
        'ville',
        'methode_livraison',
        'adresse',
        'status'
    ];

    public function produits()
{
    return $this->belongsToMany(Product::class)
                ->withPivot('quantite')
                ->withTimestamps();
}
public function wilaya()
{
    return $this->belongsTo(\App\Models\Wilaya::class, 'wilaya');
}

public function commune()
{
    return $this->belongsTo(\App\Models\Commune::class, 'ville');
}


}
