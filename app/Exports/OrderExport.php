<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Order::query();
    }

    public function headings(): array
    {
        return ["ID", "OrderName", "CustomerName", "OrderDate", "GrandTotal", "CreatedAt", "UpdatedAt"];
    }
}
