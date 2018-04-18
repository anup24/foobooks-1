<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Book;

class BookController extends Controller
{
    /*
     * GET /books
     */
    public function index()
    {
        $books = Book::orderBy('title')->get();

        # Query the database to get the last 3 books added
        # $newBooks = Book::latest()->limit(3)->get();

        # [Better] Query the existing Collection to get the last 3 books added
        $newBooks = $books->sortByDesc('created_at')->take(3);

        return view('books.index')->with([
            'books' => $books,
            'newBooks' => $newBooks,
        ]);
    }

    /*
     * GET /books/{id}
     */
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with(
                ['alert' => 'Book ' . $id . ' not found.']
            );
        }

        return view('books.show')->with([
            'book' => $book
        ]);
    }

    /**
     * GET /books/search
     * @Todo: Refactor to search the books in the database, not books.json
     * @Todo: Outsource some of the logic to a separate class
     */
    public function search(Request $request)
    {
        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path('/books.json'));

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v0 of foobooks we built earlier in the semester
            foreach ($books as $title => $book) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                    # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }

        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    /**
     * Show the form to create a new book
     * GET /books/create
     */
    public function create(Request $request)
    {
        return view('books.create');
    }

    /**
     * Process the form to create a new book
     * POST /books
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'published_year' => 'required|digits:4|numeric',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url',
        ]);

        # Save the book to the database
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;
        $book->save();

        # Logging code just as proof of concept that this method is being invoked
        # Log::info('Add the book ' . $book->title);

        # Send the user back to the page to add a book; include the title as part of the redirect
        # so we can display a confirmation message on that page
        return redirect('/books/create')->with([
            'alert' => 'Your book ' . $book->title . ' was added.'
        ]);
    }

    /**
     * Show the form to edit an existing book
     * GET /books/{id}/edit
     */
    public function edit($id)
    {
        # Find the book the visitor is requesting to edit
        $book = Book::find($id);

        # Handle the case where we can't find the given book
        if (!$book) {
            return redirect('/books')->with(
                ['alert' => 'Book ' . $id . ' not found.']
            );
        }

        # Show the book edit form
        return view('books.edit')->with([
            'book' => $book
        ]);
    }

    /**
     * Process the form to edit an existing book
     * PUT /books/{id}
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'published_year' => 'required|digits:4|numeric',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url',
        ]);

        # Fetch the book we want to update
        $book = Book::find($id);

        # Update data
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;

        # Save edits
        $book->save();

        # Send the user back to the edit page in case they want to make more edits
        return redirect('/books/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved'
        ]);
    }
}
