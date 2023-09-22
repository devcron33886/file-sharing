<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required,max:255,string',
            'department_id' => 'required,integer,exists:departments,id',
            'receiver_id' => 'required,integer,exists:users,id',
            'documents' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'sender_id' => 'required,integer,exists:users,id',
            'source' => 'required',
            'notes' => 'required',
            'status' => 'required',
        ];
    }
}
