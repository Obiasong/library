<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookActionsTest extends TestCase
{
    use RefreshDatabase;
//    use DatabaseMigrations;
   /** @test */
    public function a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();
//        $response = $this->get('/');
        $response = $this->post('/books', [
            'title' => "The ocean rock",
            'author' => "Victor Man",
            'category' => 'fiction'
        ]);
        $response->assertok();
        $this->assertCount(1, Book::all());
    }

    public function test_title_is_required(){
//        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => "",
            'author' => "Victor Man",
            'category' => 'fiction'
        ]);
        $response->assertSessionHasErrors('title');
    }

    public function test_author_is_required(){
//        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => "Mania Victor",
            'author' => "",
            'category' => 'fiction'
        ]);
        $response->assertSessionHasErrors('author');
    }
    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => "The ocean rock",
            'author' => "Victor Man",
            'category' => 'fiction'
        ]);

        $response = $this->patch('/books/' . Book::first()->id, [
           'title' => 'New Title',
           'author' => 'New Author',
           'category' => 'New Cat'
        ]);

        $response->assertOk();
        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $this->assertEquals('New Cat', Book::first()->category);
    }

}
