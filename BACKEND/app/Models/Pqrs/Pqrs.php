<?php

namespace App\Models\Pqrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la tabla PQRS.
 *
 * @property int $pqrs_id Identificador único de PQRS.
 * @property string $nombre Nombre del solicitante.
 * @property string $descripcion Descripción del PQRS.
 * @property string $opcion Opción seleccionada.
 * @property \Illuminate\Support\Carbon $created_at Fecha de creación.
 * @property \Illuminate\Support\Carbon $updated_at Fecha de actualización.
 */
class Pqrs extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada.
     *
     * @var string
     */
    protected $table = "pqrs";

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = "pqrs_id";

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ["nombre", "descripcion", "opcion"];

    /**
     * Los atributos que deben ocultarse para arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Los atributos que se deben convertir a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
