<?php

namespace App\Http\Controllers;

use App\DataTables\PostsDatatable;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostsController extends Controller
{

    public function index(PostsDatatable $postsDatatable)
    {
        $title = trans('admin.posts');
        return $postsDatatable->render('posts.index', compact('title'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request): \Illuminate\Http\JsonResponse
    {
        $post = Post::create($request->validated());
        return response()->json(['success' => 'post added', 'post_id' => $post->id]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->update($request->validated());
        return redirect()->route('posts.index')->with('success',trans('admin.updated_successfully'));
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        try {
            foreach ($post->attachments as $attachment) {
                $this->deletePhoto($attachment->file, 'posts');
            }
            $post->delete();
        }catch (\Exception $exception){
            return back()->with('error',trans('admin.something_went_wrong'));
        }
        return redirect()->route('posts.index')->with('success',trans('admin.deleted_successfully'));
    }

    public function deleteSelectedRows(): \Illuminate\Http\RedirectResponse
    {
        if (is_array(\request('item'))) {
            foreach (\request('item') as $item){
                $this->destroy(Post::findOrFail($item));
            }
        }
        return redirect()->route('posts.index')->with('success',trans('admin.deleted_all_successfully'));
    }

}
