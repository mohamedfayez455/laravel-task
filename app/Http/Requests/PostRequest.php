<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|min:3|max:255',
            'body'      => 'sometimes|nullable|min:3',
            'user_id'   => 'sometimes|nullable|exists:users,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'title'     => trans('admin.title'),
            'body'      => trans('admin.body'),
            'user_id'   => trans('admin.user_id'),
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => trans('admin.title_required'),
            'title.min'      => trans('admin.title_min'),
            'title.max'      => trans('admin.title_max'),

            'body.min'      => trans('admin.body_min'),

            'user_id.exists' => trans('admin.user_id_exists'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
           'user_id' => auth()->user()->id
        ]);
    }

}
