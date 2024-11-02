<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    /**
     * @param PostService $service
     * @return mixed
     */
    public function getUserPosts(PostService $service): mixed
    {
        $posts = $service->getUserPosts(Auth::user()->id);

        return view('post.user-posts', compact('posts'));
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function createComment(Post $post): mixed
    {
        return view('post.create-comment', ['post_id' => $post->id]);
    }

    /**
     * @param CreateCommentRequest $request
     * @param PostService $postService
     * @param CommentService $commentService
     * @return mixed
     */
    public function storeComment(CreateCommentRequest $request, PostService $postService, CommentService $commentService): mixed
    {
        $validatedData = $request->validated();
        $post = $postService->findById($validatedData['post_id']);
        $comment = $commentService->prepareObjectForSave($validatedData['comment']);
        $post->comments()->save($comment);
        Session::flash('message', 'Comment Created');
        return redirect()->back();
    }

    /**
     * @param PostService $service
     * @return mixed
     */
    public function index(PostService $service): mixed
    {
        $posts = $service->getPosts();

        return view('post.index', compact('posts'));
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return view('post.create');
    }

    /**
     * @param CreatePostRequest $request
     * @param PostService $service
     * @return mixed
     */
    public function store(CreatePostRequest $request, PostService $service): mixed
    {
        $post = $service->create([...$request->validated(), 'user_id' => Auth::user()->id]);

        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function show(Post $post): mixed
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

    /**
     * @param EditPostRequest $request
     * @param Post $post
     * @param PostService $service
     * @return mixed
     */
    public function update(EditPostRequest $request, Post $post, PostService $service): mixed
    {
        $service->update($post, $request->validated());
        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('message', 'Post Deleted');
        return redirect()->route('post.index');

    }
}
