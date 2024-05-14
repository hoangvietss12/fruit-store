<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class SaleExport implements FromView
{
    protected $data, $start, $end;

    public function __construct($data, $start, $end)
    {
        $this->data = $data;
        $this->start = $start;
        $this->end = $end;
    }
    public function view(): View
    {
        $start = $this->start === 'all' ? $this->data->last()['date'] : $this->start;
        $end = $this->end === 'all' ? Carbon::now()->format('d-m-Y') : $this->end;

        return view('admin.reports.export-sale', [
            'data' => $this->data,
            'start' => $start,
            'end' => $end,
        ]);
    }
}
