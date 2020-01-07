<?php

namespace App\Http\Controllers;

use App\Book;
use App\Sale;
use App\SalesBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class SalesController extends Controller {

    public function get(string $id): JsonResponse {

        $sale = Sale::find($id);

        if (empty($sale)) {

            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }

        $sale->books = $sale->books()->getResults();

        return response()->json(['sale' => $sale]);
    }

    public function buy(Request $request): JsonResponse {

        $books = json_decode($request->get('books'), true);

        if (empty($books) || !is_array($books)) {

            return new JsonResponse(
            ['error' => 'Books array is malformed.'],
            JsonResponse::HTTP_BAD_REQUEST);
        }

        $saleBooks = [];
        $bookObjects = [];

        foreach ($books as $bookId => $amount) {

            $book = Book::find($bookId);

            if (empty($book) || $book->stock < $amount) {

                return new JsonResponse(
                ['error' => "Book $bookId not valid."],
                JsonResponse::HTTP_BAD_REQUEST);
            }

            $bookObjects[] = $book;
            $saleBooks[] = [
                'book_id' => $bookId,
                'amount' => $amount
            ];
        }

        $sale = Sale::create(
            ['user_id' => Authorizer::getResourceOwnerId()]);

        foreach ($bookObjects as $key => $book) {

            $book->stock -= $saleBooks[$key]['amount'];
            $saleBooks[$key]['sale_id'] = $sale->id;
            SalesBook::create($saleBooks[$key]);
        }

        $sale->books = $sale->books()->getResults();

        return response()->json(['sale' => $sale]);
    }

    public function getAll(Request $request): JsonResponse {

        $page = $request->get('page', 1);
        $pageSize = $request->get('page-size', 50);
        $sales = Sale::where(
        'user_id', '=', Authorizer::getResourceOwnerId())
            ->take($pageSize)
            ->skip(($page - 1) * $pageSize)
            ->get();

        foreach ($sales as $sale) {

            $sale->books = $sale->books()->getResults();
        }
        
        return response()->json(['sales' => $sales]);
    }
}