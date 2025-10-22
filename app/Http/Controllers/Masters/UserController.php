<?php

namespace App\Http\Controllers\Masters;

use App\Models\Masters\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::withTrashed()->paginate(10);
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'name_last' => ['required', 'string', 'max:40'],
            'name_first' => ['nullable', 'string', 'max:40'],
            'authority' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user = User::create([
            'user_id' => $request->user_id,
            'name_last' => $request->name_last,
            'name_first' => $request->name_first,
            'name' => $request->name_last ." ". $request->name_first,
            'authority' => $request->authority,
            'email' => $request->email,
            'password' => Hash::make('init1234!'),
        ]);

        $request->session()->flash('message','登録しました');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $user->name = $request->input('name_last') ." ". $request->input('name_first');

        $validated=$request->validate([
            'name_last' => ['required', 'string', 'max:40'],
            'name_first' => ['nullable', 'string', 'max:40'],
            'name' => ['string'],
            'authority' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        //
        $user->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('user.index');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Request $request, User $user)
    {
        //
        User::onlyTrashed()->where('user_id',$user->user_id)->restore();
        $request->session()->flash('message','元に戻しました');
        return redirect()->route('user.index');
    }

    /**
     * ForceDelete the specified resource from storage.
     */
    public function forceDelete(Request $request, User $user)
    {
        //
        $user->forceDelete();
        $request->session()->flash('message','完全に削除しました');
        return redirect()->route('user.index');
    }
}
