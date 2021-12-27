<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends FormRequest
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
            'file'     => 'required|array',
            'file.*'   => 'required|image|mimes:jpg,jpeg,png|max:5000',
        ];
    }

    public function attributes(): array
    {
        return [
            'file'     => trans('admin.file'),
            'file.*'   => trans('admin.file_attachment'),
        ];
    }

    public function messages(): array
    {
        return [
            'file.required'     => trans('admin.attachments_required'),
            'file.array'        => trans('admin.attachments_is_invalid'),
            'file.*.required'   => trans('admin.attachment_is_required'),
            'file.*.mimes'      => trans('admin.attachment_mime'),
            'file.*.max'        => trans('admin.attachment_max'),
            'file.*.image'        => trans('admin.attachment_image'),
        ];
    }

}
