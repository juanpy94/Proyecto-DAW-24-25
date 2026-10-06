<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionFactura extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'configuracion_factura';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'iva',
        'precio_mano_obra',
    ];

}
