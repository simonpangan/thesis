<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $primaryKey = 'subjectid';  
    protected $fillable = [];

      //look up table (one to many side)
    public function user() 
    {
      return $this->belongsToMany(Accounts::class,'users_subject','user_id','subjectid');
    }
}
