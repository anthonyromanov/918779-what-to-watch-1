<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFilmRequest extends FormRequest
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
            'imdb' => ['required', 'regex:/^tt\d+$/', 'unique:films,imdb_id']
        ];
    }
    public function messages(): array
    {
        return [
            'imdb.regex' => 'Введите корректные данные. IMDB id должен быть в формате ttNNNN',
            'imdb.unique' => 'Упс... Такой фильм у нас уже есть'
        ];
    }

}