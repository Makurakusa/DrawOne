<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed
     */
    public function rules()
    {
        return [
            'picture.image' => 'required|image|mimes:jpeg,png,jpg|max:32768',// ファイルアップロードが行われ、画像ファイルでjpeg,png,gifのいずれか、32mbまで
            'picture.title' => 'required|string|max:100'
        ];
    }
}
