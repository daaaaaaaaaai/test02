<?php

namespace App\Http\Controllers\Customizes;

use App\Models\Customizes\RemoteCost;
use Illuminate\Http\Request;

class RemoteCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rcosts=RemoteCost::paginate(10);
        return view('customize.remotecost.index',compact('rcosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.remotecost.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'distance' => ['required', 'string', 'unique:'.RemoteCost::class],
            'cost' => ['required', 'numeric'],
        ]);

        RemoteCost::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.remotecost.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RemoteCost $remoteCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RemoteCost $remoteCost)
    {
        //
        return view('customize.remotecost.edit', compact('rcost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RemoteCost $rcost)
    {
        //
        $request->validate([
            'distance' => ['required'],
            'cost' => ['required', 'numeric'],
        ]);

        $rcost->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('remotecost.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, RemoteCost $rcost)
    {
        //
        $rcost->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('remotecost.index');
    }
}
