<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleReparacion extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'detalles_reparacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descripcion',
        'cantidad',
        'precio_unidad',
        '%_iva',
        'iva',
        '%_descuento',
        'descuento',
        'precio_total',
        'id_reparacion',
        'id_factura',
    ];

    /**
     * Relación con la tabla 'reparaciones'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reparacion(): BelongsTo
    {
        return $this->belongsTo(Reparacion::class, 'id_reparacion');
    }

    /**
     * Relación con la tabla 'facturas'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}
