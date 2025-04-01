<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorTemporario extends Model
{
    use HasFactory;

    protected $table = 'servidor_temporario';
    protected $primaryKey = 'ste_id';
    public $timestamps = false;

    protected $fillable = [
        'pes_id', 'ste_matricula', 'ste_cargo'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }

    public function lotacoes()
    {
        return $this->hasMany(Lotacao::class, 'servidor_temporario_id', 'ste_id');
    }
}

