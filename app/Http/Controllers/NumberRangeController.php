<?php

namespace App\Http\Controllers;

use App\Models\NumberRange;
use Illuminate\Http\Request;

class NumberRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $numberRanges=NumberRange::paginate(10);
        return view('numberrange.index',compact('numberRanges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('numberrange.create');
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
    public function show(NumberRange $numberRange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NumberRange $numberRange)
    {
        //
        return view('numberrange.edit', compact('numberRange'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NumberRange $numberRange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, NumberRange $numberRange)
    {
        //
        $numberRange->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('numberrange.index');
    }
}
