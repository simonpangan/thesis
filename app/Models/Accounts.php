<?php

namespace App\Models;

use App\Models\Phone;
use App\Models\Post;
use App\Models\Sex;
use App\Models\Subject;
use Cache;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword as PasswordReset;
use Illuminate\Notifications\Notifiable;

class Accounts extends Authenticatable implements MustVerifyEmail, CanResetPassword 
{
    //old User class
    //customize
    use Notifiable, HasFactory, PasswordReset;

    protected $table = 'Accounts';
    protected $primaryKey = 'AccountID';
    // public $timestamps = false;
    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'Name',
        'SexId',
        'Role',
        'userEmail',
        'Username',
        'Password',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
        'remember_key',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verifiedAt' => 'datetime',
        'two_factor_expires_at' => 'datetime',
    ];

    //custom email
    public function getEmailAttribute($value)
    {
        return $this->userEmail;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $this->verifiedAt;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['verifiedAt'] = $value;
    }

    // custom remember token name
    public function getRememberTokenName()
    {
        return 'remember_key';
    }

    //because you change password field name
    public function getAuthPassword()
    {
        return $this->Password;
    }

    //check if user is online
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->AccountID);
    }

    //one to one
    public function phone()
    {
        return $this->hasOne(Phone::class, 'accountid');
    }
    // one to many
    public function posts()
    {
        return $this->hasMany(Post::class, 'account_id');
    }

    //many to many

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'users_subject', 'user_id', 'subjectid');
    }

    //look up table (one to one side)

    public function sex()
    {
        return $this->hasOne(Sex::class, 'SexID');
    }

    //two factor authentication
    // public function generateTwoFactorCode()
    // {
    //     $this->timestamps = false;
    //     $this->two_factor_code = rand(100000, 999999);
    //     $this->two_factor_expires_at = now()->addMinutes(10);
    //     $this->save();
    // }
    // public function resetTwoFactorCode()
    // {
    //     $this->timestamps = false;
    //     $this->two_factor_code = null;
    //     $this->two_factor_expires_at = null;
    //     $this->save();
    // }

}
