<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'reportable_type' => ['required', 'string', 'in:' . implode(',', Report::REPORTABLES)],
            'reportable_id'   => ['required', 'integer', 'min:1'],
            'details_body'    => ['required', 'string', 'max:1000'],
        ];
    }
}