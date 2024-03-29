<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends \App\Models\AbstractModels\AbstractUser
{
    use GeneratesUuid, HasApiTokens, HasRoles, MustVerifyEmail, Notifiable;
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the role to display.
     */
    public function displayRole(): string
    {
        if ($this->hasRole('admin')) {
            return 'Admin';
        }

        if ($this->hasRole('moderator')) {
            return 'Moderator';
        }

        return 'Member';
    }
}
