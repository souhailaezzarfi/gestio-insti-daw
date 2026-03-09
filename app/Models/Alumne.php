<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;


class Alumne extends Model
{
    //

    public function moduls(): BelongsToMany
    {
        return $this->belongsToMany(Modul::class)->withPivot('nota');
    }
    public function grup(): BelongsTo 
    { 
        return $this->belongsTo(Grup::class); 
     }

    public static function cercaAnd($text ,$grupId, $nota)
   {
    return Alumne::where('dni', 'like', "%$text%")
        ->orWhere('cognoms', 'like', "%$text%")
        ->where('grup_id', $grupId)
        ->whereHas('moduls', function($q) use ($nota) {
        $q->where('nota', '>=', $nota);})->get();
   }

   public static function cercaOr($text ,$grupId, $nota)
{
    return Alumne::where('dni', 'like', "%$text%")
        ->orWhere('cognoms', 'like', "%$text%")
        ->orWhere('grup_id', $grupId)
        ->orWhereHas('moduls', function($q) use ($nota) {
            $q->where('nota', '>=', $nota);
        })
        ->get();
}



}
