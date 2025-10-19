<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use Illuminate\Http\Request;

class PrefectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $prefectures=Prefecture::paginate(10);
        return view('customize.prefecture.index',compact('prefectures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.prefecture.create');
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
    public function show(Prefecture $prefecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prefecture $prefecture)
    {
        //
        return view('customize.prefecture.edit', compact('prefecture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prefecture $prefecture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Prefecture $prefecture)
    {
        //
        $prefecture->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('prefecture.index');
    }
}
