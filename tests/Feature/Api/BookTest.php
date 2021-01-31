<?php

namespace Tests\Feature\Api;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_books()
    {
        $books = Book::factory()->count(3)->create();
        $jsonStructure = array_keys((new BookResource($books[0]))->resolve());
        $response = $this->json('GET', '/api/books');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $books[0]->id]);
        $response->assertJsonFragment(['id' => $books[1]->id]);
        $response->assertJsonFragment(['id' => $books[2]->id]);
        $response->assertJsonStructure([
            'data' => [
                '*' => $jsonStructure
            ],
        ]);
    }

    public function test_book_can_be_created()
    {
        $payload = [
            'title'       => 'Bear Town',
            'description' => 'Bear Town is a novel by the Swedish writer Fredrik Backman',
            'isbn'        => '123456789',
            'price'       => 1000
        ];

        $this->json('POST', '/api/books', $payload)
            ->assertStatus(201)
            ->assertJson($payload);
    }

    public function test_book_can_be_showed()
    {
        $book = Book::factory()->create();
        $bookArr = (new BookResource($book))->resolve();
        $this->json('GET', '/api/books/' . $book->id)
            ->assertStatus(200)
            ->assertJson(['data' => $bookArr]);
    }

    public function test_book_can_be_updated()
    {
        $book = Book::factory()->create();

        $payload = [
            'title'       => 'War and Peace',
            'description' => 'War and Peace is a novel by Lev Tolstoy',
            'price'       => 1500
        ];

        $this->json('PUT', '/api/books/' . $book->id, $payload)
            ->assertStatus(200)
            ->assertJson($payload);
    }

    public function test_book_can_be_deleted()
    {
        $book = Book::factory()->create();

        $this->json('DELETE', '/api/books/' . $book->id)
            ->assertStatus(204);
    }
}
