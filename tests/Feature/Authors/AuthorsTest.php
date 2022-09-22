<?php

namespace Tests\Feature;

use App\Models\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsTest extends TestCase
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

    public function test_authors_listings() : void
    {
        $this->withExceptionHandling();

        $response = $this->get('/authors');
        $response->assertStatus(200);
        $response->assertSee('Author (# Books)');
    }

    public function test_store_author_success_message() : void
    {
        $this->withExceptionHandling();

        $response=$this->post('/authors/store', [
            'name'=>'John Doe'
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);

        $response->assertStatus(201);
        $response->assertSee('Great! A new author has been created');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('authors', [
            'name'=>'John Doe'
        ]);
    }

    public function test_store_author_form_validation_fail_message() : void
    {
        $this->withExceptionHandling();

        $response=$this->post('/authors/store', [
            'name'=>null
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);

        $response->assertStatus(409);
        $response->assertSee('Oops! Please correct form validation errors');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertArrayHasKey('errors', $content);
    }

    public function test_update_author_success_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create([
            'name'=>'John Doe'
        ]);

        $id= (string) $author->id;
        $response=$this->put('/authors/update/'.$id, [
            'id'=>$id
          , 'name'=>'Jane Doe'
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! Author details have been updated');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('authors', [
            'name'=>'Jane Doe'
        ]);
    }

    public function test_delete_author_success_message() : void
    {
        $this->withExceptionHandling();

        $author=Author::factory()->create([
            'name'=>'John Doe'
        ]);

        $id= (string) $author->id;
        $response=$this->delete('/authors/delete/'.$id, [], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! You have deleted an author');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseMissing('authors', [
            'id'=>$id
        ]);
    }

}
