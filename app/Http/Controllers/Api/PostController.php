<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::get();
        if ($post->count() > 0) {
            return PostResource::collection($post);
        } else {
            return response()->json(['messages' => 'No record available'], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'title' => 'required|string|max:255',
                'description' => 'required|max:255'
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validate->messages(),
            ], 422);
        }
       $post= Post::create(
            [
                'title'=>$request->title,
                'description'=>$request->description,
            ]
        );
        return response()->json(
            [
                'message'=>'Create Successfull',
                'data' => new PostResource($post)
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validate = Validator::make($request->all(),
            [
                'title' => 'required|string|max:255',
                'description' => 'required|max:255'
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validate->messages(),
            ], 422);
        }
        $post->update(
            [
                'title'=>$request->title,
                'description'=>$request->description,
            ]
        );
        return response()->json(
            [
                'message'=>'Update Successfull',
                'data' => new PostResource($post)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message'=>'Delete Successfull'],200);
    }
}
