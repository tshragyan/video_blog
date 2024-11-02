<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $data = [
            'comment' => 'required|string|max:255'
        ];

        if (!$this->request->get('post_id')) {
            $data['video_id'] = 'required|numeric|exists:videos,id';
        }

        if (!$this->request->get('video_id')) {
            $data['post_id'] = 'required|numeric|exists:posts,id';
        }

        return $data;
    }
}
