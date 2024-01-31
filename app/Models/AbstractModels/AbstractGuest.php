<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractGuest extends Model
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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = ['banned' => false];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'ip' => 'string',
        'banned' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip'];

    public function comments(): MorphMany
    {
        return $this->morphMany(\App\Models\Comment::class, 'userable', 'userable_type', 'userable_id');
    }

    public function messages(): MorphMany
    {
        return $this->morphMany(\App\Models\Message::class, 'userable', 'userable_type', 'userable_id');
    }

    public function recordings(): MorphMany
    {
        return $this->morphMany(\App\Models\Recording::class, 'userable', 'userable_type', 'userable_id');
    }

    public function ratings(): MorphMany
    {
        return $this->morphMany(\App\Models\Rating::class, 'userable', 'userable_type', 'userable_id');
    }
}
