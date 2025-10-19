<?php

namespace App\Http\Controllers;

use App\Models\JapaneseCalendar;
use Illuminate\Http\Request;

class JapaneseCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $japaneseCalendars=JapaneseCalendar::paginate(10);
        return view('customize.japanesecalendar.index',compact('japaneseCalendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.japanesecalendar.create');
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
    public function show(JapaneseCalendar $japaneseCalendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JapaneseCalendar $japaneseCalendar)
    {
        //
        return view('customize.japanesecalendar.edit', compact('japaneseCalendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JapaneseCalendar $japaneseCalendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, JapaneseCalendar $japaneseCalendar)
    {
        //
        $japaneseCalendar->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('japanesecalendar.index');
    }
}
