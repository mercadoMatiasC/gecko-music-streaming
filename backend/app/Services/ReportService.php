<?php
namespace App\Services;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class ReportService {
    protected function resolveReportable(string $type, int $id): Model {
        $model_class = Arr::get(Report::REPORTABLE_MAP, strtolower($type));

        if (!$model_class)
            throw new InvalidArgumentException("Type [{$type}] is not reportable.");

        return $model_class::findOrFail($id);
    }

    public function storeReport(User $reporter, array $data): Report {
        $target_model = $this->resolveReportable(
            $data['reportable_type'], 
            $data['reportable_id']
        );

        return $target_model->reports()->create([
            'reporter_id'  => $reporter->id,
            'details_body' => $data['details_body'],
        ]);
    }
}