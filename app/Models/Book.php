<?php

namespace App\Models;
use Str;  


use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   protected $guarded = [];

   public function path()
   {
        return '/books/' . $this->id;
      // return '/books/' . $this->id . '-' . Str::slug($this->title);

      // /books/1-enders-game
      
   }
   // a book creates an author if it does not exist
   public function setAuthorIdAttribute($author)
   {
       $this->attributes['author_id'] = (Author::firstOrCreate([
           'name' => $author,
       ]))->id;
   }
}
