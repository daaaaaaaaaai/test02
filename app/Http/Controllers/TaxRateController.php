<?php

namespace App\Http\Controllers;

use App\Models\TaxRate;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $taxRates=TaxRate::paginate(10);
        return view('customize.taxrate.index',compact('taxRates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.customize.taxrate.create');
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
    public function show(TaxRate $taxRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaxRate $taxRate)
    {
        //
        return view('customize.taxrate.edit', compact('taxRate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaxRate $taxRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TaxRate $taxRate)
    {
        //
        $taxRate->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('responserate.index');
    }
}
