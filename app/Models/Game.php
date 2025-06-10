<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    /**
     * Codigo sinistro que muda a coluna padrao de id para uuid,
     * além de forçar o Laravel a não converter o id para incrementável (se remover, dor de cabeça garantida, rs)
     */
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * Colunas que serão modificadas do Modelo Game durante a execução do Aplicativo
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'release_date',
        'developer',
        'publisher',
        'game_picture',
    ];
    
    /**
     * Altera a coluna de busca padrão do Laravel de "id" para "uuid". Resolve problemas de consulta por objeto
     * Vou deixar esse codigo ai, se der pau, a gente tira depois
     */
    public function getRouteKeyName() {
        return "uuid";
    }
}
