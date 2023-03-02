<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UploadRequest extends FormRequest
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
            'document_name'         => 'required',
            'document_source'       => 'required',
            'file'                  => [File::types(['jpeg', 'jpg', 'png', 'pdf', 'doc', 'JPG', 'JPEG', 'docx', 'xls', 'xlsx', 'txt', 'ppt', 'pptx', 'mp3', 'mp4', 'zip', 'csv', 'svg', 'gif', 'avi', 'mov', 'flv', 'odp', 'wav', 'wma'])]
        ];
    }
}
