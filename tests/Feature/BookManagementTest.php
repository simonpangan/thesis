<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase; //will migrate a database for testing then immediately tears down

    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling(); //this gives the actual error message

        $response = $this->post('/books', [

            'title' => 'Cool Book Title',
            'author' => 'Victor',
        ]);

        $book = Book::first();
        // $response->assertOk();
        $this->assertCount(1, Book::all());

        $response->assertRedirect("/books/" . $book->id);
    }

    //validation for testing

    public function test_a_title_is_required()
    {
        //   $this->withoutExceptionHandling();
        $response = $this->post('/books', [

            'title' => '',
            'author' => 'Victor',

        ]);
        $response->assertSessionHasErrors('title');
    }

    public function test_a_author_is_required()
    {
        //   $this->withoutExceptionHandling();

        $response = $this->post('/books', [

            'title' => 'Cool title',
            'author' => '',

        ]);
        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [

            'title' => 'Cool Title',
            'author' => 'Victor',

        ]);
        $book = Book::first();
        // $response = $this->patch("/books/" . $book->id, [
        $response = $this->patch($book->path(), [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
  
        $response->assertRedirect($book->fresh()->path());
         //because kapag walang fresh yung old data parin yugn gamit //old title
    }

    public function test_a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [

            'title' => 'Cool Title',
            'author' => 'Victor',

        ]);

     

        $book = Book::first();
        $this->assertCount(1, Book::all());
        $response = $this->delete("/books/" . $book->id);
       
        $this->assertCount(0, Book::all());

        $response->assertRedirect("/books/");
    }

}
