<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BookController extends Controller {

    public function get(string $id): JsonResponse {

        $book = Book::find($id);

        if (empty($book)) {

            return new JsonResponse(null,JsonResponse::HTTP_NOT_FOUND);
        }
            return response()->json(['book' => $book]);
    }

    public function getAll(Request $request): JsonResponse {

        $title = $request->get('title', '');
        $author = $request->get('author', '');
        $page = $request->get('page', 1);
        $pageSize = $request->get('page-size', 50);

        $books = Book::where('title', 'like', "%$title%")
            ->where('author', 'like', "%$author%")
            ->take($pageSize)
            ->skip(($page - 1) * $pageSize)
            ->get();

        return response()->json(['books' => $books]);
    }
}