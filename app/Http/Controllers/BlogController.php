<?php

namespace App\Http\Controllers;

use App\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()
            ->view('blog.index', ['blogs' => Blog::with(['user', 'messages', 'category'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()
            ->view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $blog = Blog::create($request->validate([
            'title' => 'required|unique:App\Blog,title',
            'body' => 'required',
            'category_id' => 'required|exists:App\Category,id'
        ]));

        $blog->{"message"} = "Blog successfully posted!";

        return response($blog, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return Response
     */
    public function show(Blog $blog)
    {
        $blog->load('messages', 'user');

        return response()
            ->view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     * @return Response
     */
    public function edit(Blog $blog)
    {
        if(auth()->id() != $blog->user_id)
            abort(403);

        return response()
            ->view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Blog $blog
     * @return Response
     */
    public function update(Request $request, Blog $blog)
    {
        if(auth()->id() != $blog->user_id)
            abort(403);

        if($blog->update($request->validate([
                'body' => 'required',
                'category_id' => 'required|exists:App\Category,id'
        ])))
            return response(['message' => "Blog successfully updated!"], 200)
                ->header('Content-Type', 'application/json');
        else
            abort('500');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return Response
     * @throws Exception
     */
    public function destroy(Blog $blog)
    {
        if(auth()->id() != $blog->user_id && !$blog->messages->count())
            abort(403);

        if($blog->delete())
            return response(['message' => "Blog deleted!"], 200)
                ->header('Content-Type', 'application/json');
        else
            abort('500');
    }
}
