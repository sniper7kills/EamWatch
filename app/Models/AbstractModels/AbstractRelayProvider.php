<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRelayProvider extends Model
{
    /**
     * Primary key type.
     *
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * Primary key is non-autoincrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'name' => 'string',
        'type' => 'string',
        'details' => 'string',
        'enabled' => 'boolean',
        'circuit_closed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'details',
        'enabled',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function relays()
    {
        return $this->hasMany(\App\Models\Relay::class, 'relay_provider_id', 'id');
    }
}
