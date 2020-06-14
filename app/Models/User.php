<?php
namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends \App\Models\AbstractModels\AbstractUser
{
    use Notifiable, MustVerifyEmail, HasRoles, GeneratesUuid, HasApiTokens;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the role to display
     *
     * @return string
     */
    public function displayRole()
    {
        if($this->hasRole('admin'))
        {
            return "Admin";
        }

        if($this->hasRole('moderator'))
        {
            return "Moderator";
        }

        return "Member";
    }
}
