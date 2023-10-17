<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Dosen::all();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', 'components.dosenAction')
                ->make();
        }

        return view('pages.dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DosenRequest $request)
    {
        $data = $request->all();
        Dosen::create($data);
        return redirect()->route('dosen.list')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('pages.dosen.edit', [
            'data' => $dosen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DosenRequest $request, string $id)
    {
        $data = $request->all();
        $dosen = Dosen::findOrFail($id);

        $dosen->update($data);
        return redirect()->route('dosen.list')->with('success', 'Berhasil Mengedit Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Dosen::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('delete', 'Berhasil menghapus data');
    }
}
