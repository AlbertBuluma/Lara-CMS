<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use Illuminate\Http\Request;
use App\Post;
use function Sodium\compare;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
//        dd($request->image->store('posts'));
        $image = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
        ]);

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Post $post)
    public function destroy($id)    //Disable route model binding and use id
    {
//        $post = Post::withTrashed()->where('id', $id)->first(); //First instance of trashed post
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();   //Throw 404 error if there's no trashed post existing

//        $post->delete();

        if ($post->trashed()){
            $post->forceDelete();   //Force delete if post has been trashed
        }else{
            $post->delete();
        }

        session()->flash('success','Post deleted successfully.');

        return redirect(route('posts.index'));
    }

    /*
* Display a list of all trashed posts.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function trashed(){

        $posts = Post::withTrashed()->get();  //Fetch all posts that have been trashed
//        $trashed = Post::withTrashed()->get();  //Fetch all posts that have been trashed

        return view('posts.index', compact('posts'));
//        return view('posts.index')->withPosts($trashed);
    }

}
