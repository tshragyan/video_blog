<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CreateVideoRequest;
use App\Http\Requests\EditVideoRequest;
use App\Models\User;
use App\Models\Video;
use App\Services\CommentService;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{

    /**
     * @param VideoService $service
     * @return mixed
     */
    public function getUserVideos(VideoService $service): mixed
    {
        $user = Auth::user();
        $videos = $service->getUserVideos($user->id);
        return view('video.user-videos', compact('videos'));

    }

    /**
     * @param Video $video
     * @return mixed
     */
    public function createComment(Video $video): mixed
    {
        return view('video.create-comment', ['video_id' => $video->id]);
    }

    /**
     * @param CreateCommentRequest $request
     * @param VideoService $videoService
     * @param CommentService $commentService
     * @return mixed
     */
    public function storeComment(CreateCommentRequest $request, VideoService $videoService, CommentService $commentService): mixed
    {
        $validatedData = $request->validated();
        $video = $videoService->findById($validatedData['video_id']);
        $comment = $commentService->prepareObjectForSave($validatedData['comment']);
        $video->comments()->save($comment);
        Session::flash('message', 'Comment Created');
        return redirect()->back();
    }

    /**
     * @param VideoService $service
     * @return mixed
     */
    public function index(VideoService $service): mixed
    {
        $videos = $service->getVideos();
        return view('video.index', compact('videos'));
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return view('video.create');
    }

    /**
     * @param CreateVideoRequest $request
     * @param VideoService $videoService
     * @return mixed
     */
    public function store(CreateVideoRequest $request, VideoService $videoService): mixed
    {
       $video = $videoService->create([...$request->validated(), 'user_id' => Auth::user()->id]);
       return redirect()->route('video.show', ['video' => $video->id]);
    }

    /**
     * @param Video $video
     * @return mixed
     */
    public function show(Video $video): mixed
    {
        return view('video.show', ['video' => $video]);
    }

    /**
     * @param Video $video
     * @return mixed
     */
    public function edit(Video $video): mixed
    {
        return view('video.edit', ['video' => $video]);
    }

    /**
     * @param EditVideoRequest $request
     * @param Video $video
     * @param VideoService $service
     * @return mixed
     */
    public function update(EditVideoRequest $request, Video $video, VideoService $service): mixed
    {
        $service->update($video, $request->validated());
        return redirect()->route('video.show', ['video' => $video->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        Session::flash('message', 'Video Deleted');
        return redirect()->route('video.index');
    }
}
