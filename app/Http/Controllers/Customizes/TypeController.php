<?php

namespace App\Http\Controllers\Customizes;

use App\Models\Customizes\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $types=Type::paginate(10);
        return view('customize.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type' => ['required', 'string', 'max:2', 'unique:'.Type::class],
            'text' => ['required', 'string'],
        ]);

        Margin::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.type.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
        return view('customize.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        //
        $request->validate([
            'type' => ['required'],
            'text' => ['required', 'string'],
        ]);

        $type->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('type.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Type $type)
    {
        //
        $type->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('type.index');
    }
}
