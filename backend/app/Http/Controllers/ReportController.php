<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller {
    public function myReports() {
        $reports = Auth::user()->reports()->with(['reporter', 'reportable'])->orderBy('created_at', 'desc')->paginate(8);
        return ReportResource::collection($reports);
    }

    public function index() {
        //ADMIN VIEW, LATER WILL FEATURE FILTERS
        //-- ADMIN MIDDLEWARE/GATE/POLICY LOGIC FOR NOW --
        $is_admin = Auth::user()->isAdmin();
        
        if (!$is_admin)
            throw new BusinessException("You are not allowed to see the requested resource.");
        //-- END --

        $reports = Report::with(['reporter', 'reportable'])->orderBy('created_at', 'desc')->paginate(8);
        return ReportResource::collection($reports);
    }

    public function store(ReportRequest $request, ReportService $report_service) {
        $auth_user = Auth::user();
        $data = $request->validated();

        $new_report = $report_service->storeReport($auth_user, $data);
        
        return (new ReportResource($new_report))->response()->setStatusCode(201);
    }

    public function show(Report $report) {
        $report->load(['reporter', 'reportable']);
        return new ReportResource($report);
    }

    public function destroy(Report $report) {
        //-- ADMIN MIDDLEWARE/GATE/POLICY LOGIC FOR NOW --
        $is_admin = Auth::user()->isAdmin();
        
        if (!$is_admin)
            throw new BusinessException("You are not allowed to delete the requested resource.");
        //-- END --

        $report->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Report removed successfully'
            ], 200);
    }
}