<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use App\Models\Product;
use App\Http\Requests\StorepenggunaRequest;
use App\Http\Requests\UpdatepenggunaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('login.registerPage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'levels' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $pengguna = Pengguna::create($validatedData);

        unset($validatedData);
        return redirect()->route('login')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengguna $pengguna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengguna $pengguna)
    {
        //
    }

    public function lookVar(Request $request)
    {
        dd($request->all());
    }

    public function loginValidate(Request $request)
    {
        $users = pengguna::where('username', $request['username'])
            ->first();

        // dd($request['password']);
        if ($users && Hash::check($request['password'], $users->password)) {
            if ($users['levels'] == 1) {
                unset($users);
                return redirect()->route('produk.show');
            }
            if ($users['levels'] == 2) {
                unset($users);
                return redirect()->route('produk.display');
            }
        } else {
            unset($users);
            return view('login.loginPage');
        }
    }
}
