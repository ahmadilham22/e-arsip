<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use App\Imports\UserImport;
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
                )->make();
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

        // $validator = $request->validated();

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors());
        // }


        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->route('user.list')->with('success', 'Berhasil Menambahkan Data');
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
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('user.list')->with('success', 'Berhasil Mengedit Data');
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

    public function import(Request $request)
    {
        $data = $request->file('fileExcel');
        $namaFile = $data->getClientOriginalName();
        $data->move('dokumen/dataMahasiswa', $namaFile);

        Excel::import(new UserImport, public_path('/dokumen/DataMahasiswa/' . $namaFile));

        return redirect()->back();
    }
}
