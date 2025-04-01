<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    use HasFactory;

    protected $table = 'lotacao';
    protected $primaryKey = 'lot_id';
    public $timestamps = false;

    protected $fillable = [
        'unid_id', 'servidor_efetivo_id', 'servidor_temporario_id'
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class, 'unid_id', 'unid_id');
    }

    public function servidorEfetivo()
    {
        return $this->belongsTo(ServidorEfetivo::class, 'servidor_efetivo_id', 'sef_id');
    }

    public function servidorTemporario()
    {
        return $this->belongsTo(ServidorTemporario::class, 'servidor_temporario_id', 'ste_id');
    }
}

