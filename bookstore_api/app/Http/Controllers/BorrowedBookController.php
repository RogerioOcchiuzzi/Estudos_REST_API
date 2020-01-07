<?php
namespace App\Http\Controllers;
use App\Book;
use App\BorrowedBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class BorrowedBookController extends Controller {

    public function get(): JsonResponse {

        $borrowedBooks = BorrowedBook::where(
        'user_id', '=', Authorizer::getResourceOwnerId())->get();

        return response()->json(['borrowed-books' => $borrowedBooks]);
    }
    
    public function borrow(Request $request): JsonResponse {

        $id = $request->get('book-id');

        if (empty($id)) {

            return new JsonResponse(
            ['error' => 'Expecting book-id parameter.'],
            JsonResponse::HTTP_BAD_REQUEST);
        }

        $book = Book::find($id);

        if (empty($book)) {

            return new JsonResponse(
            ['error' => 'Book not found.'],
            JsonResponse::HTTP_BAD_REQUEST);

        } else if ($book->stock < 1) {

            return new JsonResponse(
            ['error' => 'Not enough stock.'],
            JsonResponse::HTTP_BAD_REQUEST);
        }

        $book->stock--;
        $book->save();
        $borrowedBook = BorrowedBook::create(
            [
            'book_id' => $book->id,
            'start' => date('Y-m-d H:i:s'),
            'user_id' => Authorizer::getResourceOwnerId()
            ]
        );

        return response()->json(['borrowed-book' => $borrowedBook]);
    }

    public function returnBook(string $id): JsonResponse {

        $borrowedBook = BorrowedBook::find($id);

        if (empty($borrowedBook)) {

            return new JsonResponse(
            ['error' => 'Borrowed book not found.'],
            JsonResponse::HTTP_BAD_REQUEST);
        }

        $book = Book::find($borrowedBook->book_id);
        $book->stock++;
        $book->save();
        $borrowedBook->end = date('Y-m-d H:m:s');
        $borrowedBook->save();
        
        return response()->json(['borrowed-book' => $borrowedBook]);
    }
}