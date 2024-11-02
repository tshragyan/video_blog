<?php


namespace App\Services;


use App\Models\Post;

class PostService
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPosts(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Post::paginate(20);
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserPosts($user_id): mixed
    {
        return Post::where('user_id', $user_id)->paginate(20);
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->user_id = $data['user_id'];
        $post->save();

        return $post;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id): mixed
    {
        return Post::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param Post $post
     * @param array $data
     */
    public function update(Post $post, array $data): void
    {
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();
    }
}
