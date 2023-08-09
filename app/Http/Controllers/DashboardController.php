<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahMahasiswa = User::all()->count();
        $jumlahArsip = Arsip::all()->count();
        $jumlahDosen = Dosen::all()->count();

        $user = User::all();
        $arsip = Arsip::with(['user'])->latest('created_at')->take(7)->get();
        return view('pages.dashboard.index', [
            'JumlahUsers' => $jumlahMahasiswa,
            'JumlahArsip' => $jumlahArsip,
            'JumlahDosen' => $jumlahDosen,
            'arsip' => $arsip,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
