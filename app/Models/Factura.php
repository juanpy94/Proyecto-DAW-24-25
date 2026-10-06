<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'facturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fecha_emision',
        'estado',
        'total_factura',
        'id_usuario',
    ];

    /**
     * Relación con la tabla 'usuarios'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación con la tabla 'detalles_reparacion'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleReparacion(): HasMany
    {
        return $this->hasMany(DetalleReparacion::class, 'id_factura');
    }

}
