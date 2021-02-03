<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;

class Phone extends Model
{
    use HasFactory;
    protected $primaryKey = 'phoneid';  
    protected $fillable = [];

    public function user() 
    {
        return $this->belongsTo(Accounts::class, 'accountid');
    }
}
