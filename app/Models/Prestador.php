<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    use HasFactory;
    protected $table = 'prestadores';
    public $timestamps = false;

    public function programas()
    {
        return $this->belongsToMany(Programa::class);
    }

    /**
     * Get all of the comments for the Programa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
