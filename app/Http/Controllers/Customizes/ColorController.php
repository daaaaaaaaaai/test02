<?php

namespace App\Http\Controllers\Customizes;

use App\Models\Customizes\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colors=Color::paginate(10);
        return view('customize.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'color_code' => ['required', 'string', 'max:5', 'unique:'.Color::class],
            'color_name1' => ['required', 'string'],
            'color_name2' => ['nullable', 'string'],
        ]);

        Color::create($request->all());

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.color.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
        return view('customize.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        //
        $request->validate([
            'color_code' => ['required'],
            'color_name1' => ['required', 'string'],
            'color_name2' => ['nullable', 'string'],
        ]);

        $color->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('color.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Color $color)
    {
        //
        $color->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('color.index');
    }
}
