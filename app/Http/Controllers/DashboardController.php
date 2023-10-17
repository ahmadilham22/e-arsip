<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahArsip = Arsip::all()->count();
        $jumlahDosen = Dosen::all()->count();

        $user = User::all();
        $arsip = Arsip::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where('status_arsip', 1)->latest('created_at')->take(7)->get();
        return view('pages.dashboard.index', [
            'JumlahArsip' => $jumlahArsip,
            'JumlahDosen' => $jumlahDosen,
            'arsip' => $arsip,
            'user' => $user
        ]);
    }

    public function ars()
    {
        $data = Arsip::with(['user'])->get();
        return view('pages.dashboard.arsipauth', [
            'data' => $data
        ]);
    }

    public function myArsip()
    {
        $userId = Auth::id();

        $arsips = Arsip::where('user_id', $userId)->get();
        $data = Arsip::with(['user' => function ($query) {
            $query->withTrashed();
        }])->latest('created_at')->get();
        $user = User::all();
        return view('pages.arsip.myArsip', compact('user', 'data', 'arsips'));
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
        $arsip = Arsip::findOrFail($id);
        $arsip->update(['status_arsip' => 1]);

        return redirect()->route('dahboard.arsip')->with('success', 'Berhasil menampilkan arsip di halaman arsip');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
