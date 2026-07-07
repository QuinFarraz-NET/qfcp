<?php

namespace App\Http\Controllers\Internal;

use App\Core\QFSense\TelemetryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class QFSenseController extends Controller
{
    public function __invoke(
        TelemetryService $telemetry
    ): JsonResponse {

        return response()->json(
            $telemetry->snapshot(),
            200,
            [],
            JSON_PRETTY_PRINT
        );

    }
}
