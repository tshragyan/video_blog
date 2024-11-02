<?php


namespace App\Services;


use App\Models\Comment;

class CommentService
{
    /**
     * @param array $data
     * @return Comment
     */
    public function prepareObjectForSave(string $comment): Comment
    {
        return new Comment(['comment' => $comment]);
    }
}
