<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Dosen;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ArsipRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Arsip::with(['user'])->get();
            // $query['tgl_seminar'] = format('dmY');

            return DataTables::of($query)
                ->addColumn('action', function ($arsip) {
                    return view('components.arsipAction', compact('arsip'));
                })->make();
        }

        return view('pages.arsip.index');
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
        // dd($data);

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
        $data = Arsip::with(['user'])->findOrFail($id);
        // dd($data);
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
        $users = User::all();
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
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $arsip = Arsip::findOrFail($id);
        $data = $request->except('user_id');
        $file = $request->file('dokumen');


        if ($file !== null) {
            $request->file('dokumen')->move('dokumen/dataArsip', $request->file('dokumen')->getClientOriginalName());
            $data['dokumen'] = $request->file('dokumen')->getClientOriginalName();
        }

        $arsip->update($data);

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
        // dd($filename);
        $path = public_path('dokumen/dataArsip/' . $filename);
        $headers = [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT', // Past date
        ];
        return response()->download($path, $filename, $headers);
    }
}
