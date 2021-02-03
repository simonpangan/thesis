<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'postid';  
    protected $fillable = [];

    public function user() 
    {
        return $this->belongsTo(Accounts::class, 'accountid');
    }
}
