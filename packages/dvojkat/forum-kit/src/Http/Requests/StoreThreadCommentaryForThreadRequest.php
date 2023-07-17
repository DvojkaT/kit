<?php

namespace Dvojkat\Forumkit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreadCommentaryForThreadRequest extends FormRequest
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'text' => 'required|string',
            'thread_id' => 'required|integer|exists:Dvojkat\Forumkit\Models\Thread,id'
        ];
    }
}