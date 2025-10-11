<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$classifications=Classification::all();
        //$classifications = Classification::withTrashed()->paginate(10);
        $classifications=Classification::paginate(10);
        return view('classification.index',compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('classification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'class_code' => ['required', 'string', 'max:20', 'unique:'.Classification::class],
            'class_name' => ['required', 'string'],
        ]);

        Classification::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('classification.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        //
        return view('classification.edit', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classification $classification)
    {
        //
        $request->validate([
            'class_code' => ['required'],
            'class_name' => ['required', 'string'],
        ]);

        $classification->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('classification.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Classification $classification)
    {
        //
        $classification->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('classification.index');
    }
}
