<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

abstract class AbstractUser extends \Illuminate\Foundation\Auth\User
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
    protected $attributes = ['banned' => False];
    
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'banned' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    /**  
     * The guarded property should contain an array of attributes that you do not want to be mass assignable.
     * 
     * @var array
     */
    protected $guarded = ['password'];
    
    /**  
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'email'
    ];
    
    public function relayProviders()
    {
        return $this->hasMany('\App\Models\RelayProvider', 'user_id', 'id');
    }
    
    public function comments()
    {
        return $this->morphMany('\App\Models\Comment', 'userable', 'userable_type', 'userable_id');
    }
    
    public function messages()
    {
        return $this->morphMany('\App\Models\Message', 'userable', 'userable_type', 'userable_id');
    }
    
    public function recordings()
    {
        return $this->morphMany('\App\Models\Recording', 'userable', 'userable_type', 'userable_id');
    }
    
    public function ratings()
    {
        return $this->morphMany('\App\Models\Rating', 'userable', 'userable_type', 'userable_id');
    }
}
