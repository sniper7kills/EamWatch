<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractMessage extends Model
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
    protected $attributes = ['visible' => true];
    
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'userable_id' => 'string',
        'userable_type' => 'string',
        'message' => 'string',
        'type' => 'string',
        'sender' => 'string',
        'receiver' => 'string',
        'broadcast_ts' => 'datetime',
        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
    
    /**  
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'message',
        'type',
        'sender',
        'receiver',
        'broadcast_ts'
    ];
    
    public function relays()
    {
        return $this->hasMany('\App\Models\Relay', 'message_id', 'id');
    }
    
    public function recordings()
    {
        return $this->hasMany('\App\Models\Recording', 'message_id', 'id');
    }
    
    public function userable()
    {
        return $this->morphTo('userable', 'userable_type', 'userable_id');
    }
    
    public function comments()
    {
        return $this->morphToMany('\App\Models\Comment', 'commentable', 'commentables', 'commentable_id', 'comment_id', 'id', 'id');
    }
    
    public function ratings()
    {
        return $this->morphToMany('\App\Models\Rating', 'ratingable', 'ratingables', 'ratingable_id', 'rating_id', 'id', 'id');
    }
}
