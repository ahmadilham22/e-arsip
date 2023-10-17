<?php

namespace App\Http\Controllers;

use App\Exports\TemplateUser;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use App\Models\Arsip;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::all();

            return DataTables::of($query)
                ->addColumn(
                    'action',
                    function ($user) {
                        return view('components.userAction', compact('user'));
                    }
                )->addIndexColumn()->make();
        }

        return view('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->route('user.list')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('pages.user.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('user.list')->with('success', 'Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('delete', 'Berhasil Menghapus data');
    }

    public function import(ExcelRequest $request)
    {
        $data = $request->file('fileExcel');
        $namaFile = $data->getClientOriginalName();
        $data->move('dokumen/dataMahasiswa', $namaFile);

        try {
            Excel::import(new UserImport, public_path('/dokumen/DataMahasiswa/' . $namaFile));
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function contoh()
    {
        $query = User::all();

        return view('pages.user.template', ['users' => $query]);
    }

    public function templateExcel()
    {
        return Excel::download(new TemplateUser, 'template_user.xlsx');
    }
}
