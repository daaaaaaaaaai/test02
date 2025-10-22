<?php

namespace App\Http\Controllers\Customizes;

use App\Models\Customizes\Margin;
use Illuminate\Http\Request;

class MarginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $margins=Margin::paginate(10);
        return view('customize.margin.index',compact('margins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.margin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type' => ['required', 'string', 'max:2', 'unique:'.Margin::class],
            'rate' => ['required', 'numeric'],
        ]);

        Margin::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.margin.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Margin $margin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Margin $margin)
    {
        //
        return view('customize.margin.edit', compact('margin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Margin $margin)
    {
        //
        $request->validate([
            'type' => ['required'],
            'rate' => ['required', 'numeric'],
        ]);

        $margin->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('margin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Margin $margin)
    {
        //
        $margin->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('margin.index');
    }
}
