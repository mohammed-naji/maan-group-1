<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json(['status' => 200, 'post' => $post, 'action' => 'done']);
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }

    public function getData()
    {
        return Post::latest()->get();
    }

    public function search()
    {
        return view('posts.search');
    }

    public function search_post()
    {
        $keyword = request()->k;
        $posts = Post::where('title', 'like', "%$keyword%")->orWhere('content', 'like', "%$keyword%")->get();
        return $posts;
    }

    public function search2()
    {
        return view('posts.search2');
    }

    public function search_post2()
    {
        $keyword = request()->k;
        $posts = Post::where('title', 'like', "%$keyword%")
        ->orWhere('content', 'like', "%$keyword%")
        ->get()
        ->map(function($post) {
            return [
                'title' => $post->title,
                'url' => route('posts.show', $post->id)
            ];
        });
        return $posts;
    }

    public function posts_api()
    {
        return view('posts.posts_api');
    }

    public function ajax_file()
    {
        return view('posts.ajax_file');
    }

    public function ajax_file_store(Request $request)
    {
        // $request->validate(['file' => 'required']);
        $valid = Validator::make($request->all(), [
            'file' => 'required|image|mimes:png,jpg',
        ]);
        if($valid->fails()) {
            $errors = $valid->errors();
            return view('posts.errors', compact('errors'))->render();
        }

        $file = $request->file('file');
        $ex = $file->getClientOriginalExtension();
        $new_name = rand().'_'.rand().'.'.$ex;
        $file->move(public_path('files'), $new_name);

        return "<img src='" . asset("files/$new_name") . "' />";
    }
}
