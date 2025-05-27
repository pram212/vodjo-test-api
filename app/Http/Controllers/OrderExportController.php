<?php

namespace App\Http\Controllers;

use App\Jobs\ExportOrderJob;
use Illuminate\Http\Request;

class OrderExportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        ExportOrderJob::dispatch();
        return response()->json(['message' => 'Export started']);
    }
}
