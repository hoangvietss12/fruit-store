<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class ProductExport implements FromView
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
        $start = $this->start === 'all' ? Carbon::now()->format('d-m-Y') : $this->start;
        $end = $this->end === 'all' ? Carbon::now()->format('d-m-Y') : $this->end;

        return view('admin.reports.export-product', [
            'data' => $this->data,
            'start' => $start,
            'end' => $end,
        ]);
    }
}
