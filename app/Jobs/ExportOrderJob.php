<?php

namespace App\Jobs;

use App\Events\ExportFinished;
use App\Exports\OrderExport;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportOrderJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    public function handle()
    {
        $filename = 'exports/users_export_' . now()->timestamp . '.xlsx';

        Excel::store(new OrderExport, $filename, 'public');

        ExportFinished::dispatch($filename);
    }
}
