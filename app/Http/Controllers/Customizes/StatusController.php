<?php

namespace App\Http\Controllers\Customizes;

use App\Http\Controllers\Controller;
use App\Models\Customizes\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stats=Status::paginate(10);
        return view('customize.status.index',compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'status' => ['required', 'string', 'max:20', 'unique:'.Status::class],
            'text'   => ['required', 'string'],
        ]);

        Status::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.status.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
        return view('customize.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //
        $request->validate([
            'status' => ['required'],
            'text'   => ['required', 'string'],
        ]);

        $status->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('status.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Status $status)
    {
        //
        $status->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('status.index');
    }
}
