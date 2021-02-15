<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitTest extends TestCase
{
    use RefreshDatabase; 
    
    public function testOnlyNameIsRequiredToCreateAnAuthor()
    {
        Author::firstOrCreate([
            'name' => 'John Doe',
        ]);
        $this->assertCount(1, Author::all());
    }
}
