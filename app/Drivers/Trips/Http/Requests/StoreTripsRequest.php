<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreTripsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv,txt'
        ];
    }
}
