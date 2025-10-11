<?php

namespace App\Http\Controllers;

use App\Models\ResponseRate;
use Illuminate\Http\Request;

class ResponseRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $responseRates=ResponseRate::paginate(10);
        return view('responserate.index',compact('responseRates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('responserate.create');
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
    public function show(ResponseRate $responseRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResponseRate $responseRate)
    {
        //
        return view('responserate.edit', compact('responseRate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResponseRate $responseRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ResponseRate $responseRate)
    {
        //
        $responseRate->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('responserate.index');
    }
}
