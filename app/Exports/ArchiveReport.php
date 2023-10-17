<?php

namespace App\Exports;

use App\Models\Arsip;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArchiveReport implements FromView, ShouldAutoSize
{

    use Exportable;

    private $arsip;

    public function __construct()
    {
        $this->arsip =
            Arsip::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();;
    }

    public function view(): View
    {
        return view('pages.arsip.download', [
            'arsip' => $this->arsip,
        ]);
    }
}
