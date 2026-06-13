<?php 
namespace App\Http\Resources; 

use Illuminate\Http\Request; 
use Illuminate\Http\Resources\Json\JsonResource; 

class ReportResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'reporter' => $this->whenLoaded('reporter', function() {
                return [
                    'id' => $this->reporter->id,
                    'username' => $this->reporter->username,
                ];
            }),

            'reportable_type' => strtolower(class_basename($this->reportable_type)),
            'target' => $this->whenLoaded('reportable'), 

            'details_body' => $this->details_body,
            'created_at' => $this->created_at,
        ];
    }
}