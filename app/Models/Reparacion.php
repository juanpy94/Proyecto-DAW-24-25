<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reparacion extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'reparaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'estado',
        'fecha_entrada',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'id_usuario',
        'id_vehiculo_maquina',
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
     * Relación con la tabla 'vehiculos_maquinarias'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehiculoMaquina(): BelongsTo
    {
        return $this->belongsTo(VehiculoMaquina::class, 'id_vehiculo_maquina');
    }
}
