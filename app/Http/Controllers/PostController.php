<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostIndexRequest $request)
    {
        $posts = Post::query()
        ->when($request->search, function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString(); 

        return Inertia::render('Posts/Index', [
            'posts'   => $posts,
            'filters' => $request->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('uploads/image', $image, $imagename);
            $url = Storage::url($path);

            $data['image'] = $url;
        }

        $data['title'] = $request->title;
        $data['email'] = $request->email;

        Post::create($data);

        return redirect()->route('posts.index');
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
        return  Inertia::render('Posts/Edit',[
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post,PostUpdateRequest $request)
    {

        $request->validate([
            'title' => 'required',
            'email' => 'required|email'
        ]);
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('uploads/image', $image, $imagename);
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
