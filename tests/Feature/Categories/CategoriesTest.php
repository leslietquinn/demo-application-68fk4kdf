<?php

namespace Tests\Feature;

use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
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

    public function test_categories_listings() : void
    {
        $this->withExceptionHandling();

        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertSee('Category (# Books)');
    }

    public function test_store_category_success_message() : void
    {
        $this->withExceptionHandling();

        $response=$this->post('/categories/store', [
            'name'=>'Fantasy'
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);

        $response->assertStatus(201);
        $response->assertSee('Great! A new category has been created');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('categories', [
            'name'=>'Fantasy'
        ]);
    }

    public function test_store_category_form_validation_fail_message() : void
    {
        $this->withExceptionHandling();

        $response=$this->post('/categories/store', [
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

    public function test_update_category_success_message() : void
    {
        $this->withExceptionHandling();

        $category=Category::factory()->create([
            'name'=>'Horror'
        ]);

        $id= (string) $category->id;
        $response=$this->put('/categories/update/'.$id, [
            'id'=>$id
          , 'name'=>'Fantasy'
        ], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! Category details have been updated');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseHas('categories', [
            'name'=>'Fantasy'
        ]);
    }

    public function test_delete_category_success_message() : void
    {
        $this->withExceptionHandling();

        $category=Category::factory()->create([
            'name'=>'Fantasy'
        ]);

        $id= (string) $category->id;
        $response=$this->delete('/categories/delete/'.$id, [], [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ]);
        
        $response->assertStatus(201);
        $response->assertSee('Great! You have deleted a category');

        $content=json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);

        $this->assertDatabaseMissing('categories', [
            'id'=>$id
        ]);
    }

}
