<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class AbstractRelay extends Model
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
        'message_id' => 'string',
        'relay_provider_id' => 'string',
        'response' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['response'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }

    public function relayProvider(): BelongsTo
    {
        return $this->belongsTo(\App\Models\RelayProvider::class, 'relay_provider_id', 'id');
    }
}
