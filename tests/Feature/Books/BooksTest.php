<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function setUp() : void
    {
        parent::setUp();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_books_listings() : void
    {
        $this->withExceptionHandling();

        $response = $this->get('/books');
        $response->assertStatus(200);
        $response->assertSee('Book (Author)');
    }

    public function test_store_book_success_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create();
        $category=Category::factory()->create();

        $author_id= (string) $author->id;
        $category_id= (string) $category->id;
        $response=$this->post('/books/store', [
            'name'=>'Fire Ice'
          , 'author_id'=>$author_id
          , 'category_id'=>$category_id
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! A new book has been created');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('books', [
            'name'=>'Fire Ice'
        ]);
    }

    public function test_store_book_form_validation_fail_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create();
        $category=Category::factory()->create();

        $author_id= (string) $author->id;
        $category_id= (string) $category->id;
        $response=$this->post('/books/store', [
            'name'=>null
          , 'author_id'=>$author_id
          , 'category_id'=>$category_id
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(409);
        $response->assertSee('Oops! Please correct form validation errors');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertArrayHasKey('errors', $content);
    }

    public function test_update_book_success_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create();
        $category=Category::factory()->create();

        $author_id= (string) $author->id;
        $category_id= (string) $category->id;

        $book=Book::factory()->create([
            'name'=>'Fire Ice'
          , 'author_id'=>$author_id
          , 'category_id'=>$category_id
        ]);

        $id= (string) $book->id;
        $response=$this->put('/books/update/'.$id, [
            'id'=>$id
          , 'name'=>'The Jungle'
          , 'author_id'=>$author_id
          , 'category_id'=>$category_id
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! Book details have been updated');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('books', [
            'name'=>'The Jungle'
        ]);
    }

    public function test_delete_book_success_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create();
        $category=Category::factory()->create();

        $author_id= (string) $author->id;
        $category_id= (string) $category->id;

        $book=Book::factory()->create([
            'name'=>'Fire Ice'
          , 'author_id'=>$author_id
          , 'category_id'=>$category_id
        ]);

        $id= (string) $book->id;
        $response=$this->delete('/books/delete/'.$id, [], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! You have deleted a book');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseMissing('books', [
            'id'=>$id
        ]);
    }

}
