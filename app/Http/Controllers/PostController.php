<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function index() {
        $posts = Post::all();

        return $this->sendResponse(PostResource::collection($posts), 'Post retrieved successfully.');
    }

    public function store(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'judul' => 'required',
            'penulis' => 'required',
            'subbab' => 'required',
            'isi_subbab' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = Post::create($input);

        return $this->sendResponse(new PostResource($post), 'Post created successfully');
    }

    public function show($id) {
        $post = Post::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully');
    }

    //update masih didebug belum work
    public function update(Request $request, Post $post) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'judul' => 'nullable',
            'penulis' => 'nullable',
            'subbab' => 'nullable',
            'isi_subbab' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // return $this->sendError($request);

        // $post->judul = $input['judul'];
        $post->penulis = $input['penulis'];
        // $post->subbab = $input['subbab'];
        // $post->isi_subbab = $input['isi_subbab'];

        $post->save();

        return $this->sendResponse(new PostResource($input), 'Post updated successfully.');
    }

    public function destroy(Post $post) {
        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
