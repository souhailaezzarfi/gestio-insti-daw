<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;



class Professor extends Model
{
    //

    public function moduls(): HasMany
    {
        return $this->hasMany(Modul::class);
    }

     public function grup(): HasOne
    {
        return $this->hasOne(Grup::class);
    }

    public static function ordenar($camp, $direccio) { 
        return Professor::orderBy($camp, $direccio)->get(); 
    }

}
