<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Posts/Index',[
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('public')->put('uploads/image', $image);
            $url = Storage::url($path);

            $data['image'] = $url;
        }

        $data['title'] = $request->title;
        $data['email'] = $request->email;

        Post::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return  Inertia::render('Posts/Index',[
            'post' => $post,
            'posts' => Post::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post,Request $request)
    {
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('public')->put('uploads/image', $image);
            $url = Storage::url($path);

            $data['image'] = $url;
        }

        $data['title'] = $request->title;
        $data['email'] = $request->email;

        $post->update($data);
        return redirect()->route('posts.index', [], 303);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index', [], 303);
    }

}
