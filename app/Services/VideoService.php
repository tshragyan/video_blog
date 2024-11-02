<?php


namespace App\Services;

use App\Models\Video;

class VideoService
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getUserVideos(int $id): mixed
    {
        return Video::where('user_id', $id)->paginate();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getVideos(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Video::paginate(20);
    }

    /**
     * @param array $data
     * @return Video
     */
    public function create(array $data): Video
    {
        $post = new Video();
        $post->title = $data['title'];
        $post->url = $data['url'];
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
        return Video::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param Video $post
     * @param array $data
     */
    public function update(Video $post, array $data): void
    {
        $post->title = $data['title'];
        $post->url = $data['url'];
        $post->save();
    }
}
