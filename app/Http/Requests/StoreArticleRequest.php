<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'title' => 'required|max:30',
            'description' => 'required',
            'content' => 'required',
            // 'user_id' => 'required',
            // 'category_id' => 'required',
            // 'tag_id' => 'required',
            // 'published_at' => 'required|date',
        ];
    }
}