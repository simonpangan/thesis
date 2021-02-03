<?php

namespace App\Models;

use App\Models\Phone;
use App\Models\Sex;
use App\Models\Post;
use App\Models\Subject;
use Cache;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Accounts extends Authenticatable implements MustVerifyEmail
{
    //old User class
    //customize
    use Notifiable, HasFactory;

    protected $table = 'Accounts';
    protected $primaryKey = 'AccountID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'SexId',
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
        return $this->belongsToMany(Subject::class,'users_subject','user_id','subjectid');
    }

    //look up table (one to one side)

    public function sex()
    {
        return $this->hasOne(Sex::class, 'SexID');
    }

}
