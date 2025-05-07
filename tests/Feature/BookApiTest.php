<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    public function test_authenticated_user_can_list_books()
    {
        Book::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/books');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }


    public function test_unauthenticated_user_cannot_access_books()
    {
        $response = $this->getJson('/api/books');

        $response->assertStatus(401); // Unauthorized
    }


    public function test_authenticated_user_can_create_a_book()
    {
        $data = [
            'title' => 'Nou llibre',
            'author' => 'Autor X',

        ];

        $response = $this->actingAs($this->user)->postJson('/api/books', $data);

        $response->assertStatus(201)->assertJsonPath('data.title', $data['title']);

        $this->assertDatabaseHas('books', $data);
    }


    public function test_authenticated_user_can_update_a_book()
    {
        $book = Book::factory()->create();

        $update = ['title' => 'Títol actualitzat'];

        $response = $this->actingAs($this->user)->putJson("/api/books/{$book->id}", $update);

        $response->assertStatus(200)->assertJsonPath('data.title', $update['title']);
    }


    public function test_authenticated_user_can_delete_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
