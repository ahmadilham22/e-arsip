<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Dosen;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Exports\ArchiveReport;
use App\Exports\ExportArchive;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArsipRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ArsipUpdateRequest;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Arsip::with(['user' => function ($query) {
                $query->withTrashed();
            }])
                ->join('users', 'archives.user_id', '=', 'users.id')
                ->select('archives.id as arsip_id', 'users.id as user_id', 'archives.judul', 'archives.ruang', 'archives.jenis_laporan', 'archives.tgl_seminar', 'archives.created_at')
                ->orderBy('created_at', 'desc');

            // dd($query);
            if ($request->filled('tahun')) {
                $query->whereYear('tgl_seminar', $request->tahun);
            }

            if ($request->filled('angkatan')) {
                $query->where('angkatan', $request->angkatan);
            }

            $arsips = $query->get();
            // dd($query->toSql(), $query->getBindings());
            // dd($arsips);

            $arsips->each(function ($arsip, $index) {
                $arsip->index = $index + 1;
            });


            return DataTables::of($arsips)
                ->addColumn('action', function ($arsip) {

                    return view('components.arsipAction', compact('arsip'));
                })->addIndexColumn()->make(true);
        }
        $yearsData = Arsip::selectRaw('YEAR(tgl_seminar) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        // Log::info("Query Result perc2: \n" . json_encode($arsips, JSON_PRETTY_PRINT));

        $angkatanData = User::select('angkatan')
            ->whereNotNull('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan')
            ->toArray();


        $years = array_combine($yearsData, $yearsData);
        $generations = array_combine($angkatanData, $angkatanData);
        // dd($generations);
        return view('pages.arsip.index', compact('years', 'generations'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('role', 'mahasiswa')->get();
        $dosen = Dosen::all();
        return view('pages.arsip.create', [
            'users' => $user,
            'dosens' => $dosen,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArsipRequest $request)
    {
        $data = Arsip::create($request->all());

        if ($request->has('berita_acara')) {
            $request->file('berita_acara')->move('dokumen/beritaAcara', $request->file('berita_acara')->getClientOriginalName());
            $data->berita_acara = $request->file('berita_acara')->getClientOriginalName();
        }

        $request->file('dokumen')->move('dokumen/dataArsip', $request->file('dokumen')->getClientOriginalName());
        $data->dokumen = $request->file('dokumen')->getClientOriginalName();

        $data->save();

        return redirect()->route('arsip.list')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Arsip::with(['user' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        return view('pages.arsip.show', [
            'arsip' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        $users = User::where('role', 'mahasiswa')->get();
        $dosens = Dosen::all();
        return view('pages.arsip.edit', [
            'users' => $users,
            'dosens' => $dosens,
            'arsip' => $arsip
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArsipUpdateRequest $request, string $id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($request->file('dokumen') !== null) {
            $request->file('dokumen')->move('dokumen/dataArsip', $request->file('dokumen')->getClientOriginalName());
            $data['dokumen'] = $request->file('dokumen')->getClientOriginalName();
        }

        if ($request->file('berita_acara') !== null) {
            $request->file('berita_acara')->move('dokumen/beritaAcara', $request->file('berita_acara')->getClientOriginalName());
            $data['berita_acara'] = $request->file('berita_acara')->getClientOriginalName();
        }

        $arsip->update($request->all());

        return redirect()->route('arsip.list')->with('success', 'Berhasil Mengedit Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        $arsip->delete();

        return redirect()->route('arsip.list')->with('success', 'Berhasil Menghapus data');
    }

    public function downloadPdf($id)
    {
        $data = Arsip::findOrFail($id);

        $filename = $data->dokumen;
        $path = public_path('dokumen/dataArsip/' . $filename);
        $headers = [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT', // Past date
        ];

        return response()->download($path, $filename, $headers);
    }


    public function tes()
    {
        $query = Arsip::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        return view('pages.arsip.download', ['arsip' => $query]);
    }

    public function downloadExcel()
    {
        // $data = Excel::download(new ArchiveReport(), 'arsip.xlsx');
        // return $data;
        return Excel::download(new ArchiveReport, 'archive_report.xlsx');
    }
}
