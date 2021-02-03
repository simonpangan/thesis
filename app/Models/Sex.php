<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'sextable';  
    protected $primaryKey = 'SexID';
    protected $fillable = [];

    public function users()
    {
        return $this->hasMany(Accounts::class, 'SexId');
    }
}
