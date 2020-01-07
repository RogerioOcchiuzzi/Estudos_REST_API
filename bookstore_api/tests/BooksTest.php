<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Book;

class BooksTest extends TestCase {

    use DatabaseTransactions;

    private $books = [];
    private $accessToken;

    public function setUp() {

        parent::setUp();
        $this->addBooks();
        $this->authenticate();
    }

    private function addBooks() {

        $this->books[0] = Book::create([
            'isbn' => '293842983648273',
            'title' => 'Iliad',
            'author' => 'Homer',
            'stock' => 12,
            'price' => 7.40]);
        $this->books[0]->save();
        $this->books[0] = $this->books[0]->fresh();
        $this->books[1] = Book::create([
            'isbn' => '9879287342342',
            'title' => 'Odyssey',
            'author' => 'Homer',
            'stock' => 8,
            'price' => 10.60 ]);
        $this->books[1]->save();
        $this->books[1] = $this->books[1]->fresh();
        $this->books[2] = Book::create([
            'isbn' => '312312314235324',
            'title' => 'The Illuminati',
            'author' => 'Larry Burkett',
            'stock' => 22,
            'price' => 5.10]);
        $this->books[2]->save();
        $this->books[2] = $this->books[2]->fresh();
    }

    private function authenticate() {

        $this->post(
            'oauth/access_token',[
            'client_id' => 'iTh4Mzl0EAPn90sK4EhAmVEXS',
            'client_secret' => 'PfoWM9yq4Bh6rhr8oDDsNZM',
            'grant_type' => 'client_credentials']);
        $response = json_decode(
            $this->response->getContent(), true);
        $this->accessToken = $response['access_token'];
    }
    public function testGetBook() {

        $expectedResponse = [
            'book' => json_decode($this->books[1], true)];
        $url = 'books/' . $this->books[1]->id . '?' . $this->getCredentials();
        $this->get($url)
            ->seeJson($expectedResponse)
            ->assertResponseOk();
    }

    private function getCredentials(): string {

        return 'grant_access=client_credentials&access_token='
            . $this->accessToken;
    }
    public function testGetBooksByTitle() {

        $expectedResponse = [
            'books' => [
            json_decode($this->books[0], true),
            json_decode($this->books[2], true)
            ]
            ];
        $url = 'books/?title=Il&' . $this->getCredentials();
        $this->get($url)
            ->seeJson($expectedResponse)
            ->assertResponseOk();
    }

    public function testBorrowBook() {

        $params = ['book-id' => $this->books[1]->id];
        $params = array_merge($params, $this->postCredentials());
        $this->post('borrowed-books', $params)
            ->seeJsonContains(['book_id' => $this->books[1]->id])
            ->assertResponseOk();
        $response = json_decode($this->response->getContent(), true);
        $url = 'borrowed-books' . '?' . $this->getCredentials();
        $this->get($url)
            ->seeJsonContains(['id' => $response['borrowed-book']['id']])
            ->assertResponseOk();
    }

    private function postCredentials(): array {

        return [
            'grant_access' => 'client_credentials',
            'access_token' => $this->accessToken
            ];
    }
}