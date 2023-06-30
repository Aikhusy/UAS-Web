<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Http\Requests\StoreinvoiceRequest;
use App\Http\Requests\UpdateinvoiceRequest;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $invoice=new invoice();
        $invoice->id_pengguna=$user->id;
        $invoice->status="test";
        $invoice->save();
        foreach($request['data'] as $row)
        {
            $transaksi= new transaksi();
            $transaksi->id_produk=$row['id'];
            $transaksi->id_invoice=$invoice['id'];
            $transaksi->amount=$row['total'];

            $transaksi->save();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(invoice $invoice)
    {
        //
        $id_pengguna = Auth::id();
        $invoices = Invoice::where('id_pengguna', $id_pengguna)->get();
        $title = "order";

        return view('transaksi.invoiceTable',compact('invoices'))->with('title', $title);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinvoiceRequest $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
