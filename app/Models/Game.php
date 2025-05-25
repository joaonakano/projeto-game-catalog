<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // Altera a coluna de busca padrão do Laravel de "id" para "uuid". Resolve problemas de consulta por objeto
    public function getRouteKeyName() {
            return "uuid";
    }

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'release_date',
        'developer',
        'publisher'
    ];
}
