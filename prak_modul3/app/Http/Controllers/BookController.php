<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('books.index', compact('authors'));
    }

    public function store(Request $request)
    {
        $book = Book::updateOrCreate(
            ['id' => $request->book_id],
            [
                'title' => $request->title,
                'year' => $request->year,
                'author_id' => $request->author_id,
            ]
        );

        return response()->json(['success' => 'Book saved successfully.']);
    }

    public function getBooks()
    {
        $books = Book::with('author')->get();
        return datatables()->of($books)
            ->addIndexColumn()
            ->addColumn('author_email', function($row){
                return $row->author ? $row->author->email : '-';
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editBook">Edit</a> ';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBook">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        Book::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }
}

