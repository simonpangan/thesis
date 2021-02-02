<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase; //will migrate a database for testing then immediately tears down

    public function test_an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/author', [
            'name' => 'Author Name',
            'dob' => '1988/05/14',
            // 'dob' => '05/14/1988',
        ]);

        $author = Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
    
        // // check if dbo if comming back as carbon class, meaning we are propoerly parsing it as a date
    

        $this->assertEquals('05/14/1988',$author->first()->dob->format('m/d/Y'));
    }
}
