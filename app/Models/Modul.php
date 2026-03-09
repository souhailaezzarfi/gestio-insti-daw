<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Modul extends Model
{
    //
     public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

     public function alumnes(): BelongsToMany
    {
        return $this->belongsToMany(Alumne::class)->withPivot('nota');
    }
   public static function cercaProfessor($idProfessor)
  {
    return Modul::where('professor_id', $idProfessor)->get();
  }


}
