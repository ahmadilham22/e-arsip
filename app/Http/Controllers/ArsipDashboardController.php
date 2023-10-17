<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArsipDashboardController extends Controller
{
    public function index()
    {
        $yearsData = Arsip::selectRaw('YEAR(tgl_seminar) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $allArchive = Arsip::all();

        $totalArsipPerTahun = [];
        foreach ($yearsData as $year) {
            $totalArsip = Arsip::whereYear('tgl_seminar', $year)->count();
            $totalArsipPerTahun[$year] = $totalArsip;
        }
        return view('pages.dashboard.arsipFilter', compact('yearsData', 'totalArsipPerTahun', 'allArchive'));
    }

    public function detail(Request $request, $year)
    {
        if ($request->ajax()) {
            $query = Arsip::with(['user' => function ($query) {
                $query->withTrashed();
            }])
                ->whereYear('tgl_seminar', $year)
                ->join('users', 'archives.user_id', '=', 'users.id')
                ->select('archives.id as arsip_id', 'users.id as user_id', 'archives.judul', 'archives.ruang', 'archives.jenis_laporan', 'archives.tgl_seminar', 'archives.created_at')
                ->orderBy('created_at', 'desc');

            $arsips = $query->get();

            if ($request->filled('angkatan')) {
                $query->where('angkatan', $request->angkatan);
            }

            $arsips->each(function ($arsip, $index) {
                $arsip->index = $index + 1;
            });


            return DataTables::of($arsips)
                ->addColumn('action', function ($arsip) {

                    return view('components.arsipAction', compact('arsip'));
                })->addIndexColumn()->make(true);
        }


        $angkatanData = User::select('angkatan')
            ->whereNotNull('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan')
            ->toArray();


        $generations = array_combine($angkatanData, $angkatanData);

        return view('pages.dashboard.arsip-tahun-detail', ['year' => $year, 'generations' => $generations]);
    }
}
