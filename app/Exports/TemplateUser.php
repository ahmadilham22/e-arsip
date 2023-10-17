<?php

namespace App\Exports;

use App\Models\Arsip;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplateUser implements FromView, ShouldAutoSize
{

    use Exportable;

    private $user;

    public function __construct()
    {
        $this->user =
            User::all();
    }

    public function view(): View
    {
        return view('pages.user.template', [
            'users' => $this->user,
        ]);
    }
}
