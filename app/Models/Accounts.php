<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class Accounts extends Authenticatable implements MustVerifyEmail
{
    //old User class
    //customize 
    use Notifiable;

    protected $table = 'Accounts';
    protected $primaryKey = 'AccountID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Role',
        'EmailAddress',
        'Username',
        'Password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //because you change password field name
    public function getAuthPassword()
    {
      return $this->Password;
    }

    public function isOnline()
    {
      return Cache::has('user-is-online-' . $this->AccountID);
    }

    // public function getEmailForPasswordReset()
    // {
    //     return $this->EmailAddress;
    // }

    // public function routeNotificationFor($driver)
    // {
    //     if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
    //         return $this->{$method}();
    //     }

    //     switch ($driver) {
    //         case 'database':
    //             return $this->notifications();
    //         case 'mail':
    //             return $this->EmailAddress;
    //     }
    // }
}
