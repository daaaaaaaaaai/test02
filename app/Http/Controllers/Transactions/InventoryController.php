<?php

namespace App\Http\Controllers\Transactions;

use App\Models\Transactions\Inventory;
use App\Models\Customizes\StatusValue;
use App\Models\Customizes\TypeValue;
use App\Models\Customizes\Unit;
//use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dlv=TypeValue::where('type','05')->pluck('text','value');
        $cali=TypeValue::where('type','04')->pluck('text','value');
        $theft=TypeValue::where('type','06')->pluck('text','value');
        $cr1_1=TypeValue::where('type','07')->pluck('text','value');
        $cr1_2=TypeValue::where('type','08')->pluck('text','value');
        $zr_ext=TypeValue::where('type','09')->pluck('text','value');
        $zr_moto=TypeValue::where('type','10')->pluck('text','value');
        $st_inv=StatusValue::where('status','Inventory')->pluck('text','value');
        $unit=Unit::pluck('text','unit');
        $inventories = Inventory::withTrashed()->paginate(50);
        return view('transaction.inventory.index', compact('inventories','dlv','cali','theft','cr1_1','cr1_2','zr_ext','zr_moto','st_inv','unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $inventory=new Inventory;
        return view('transaction.inventory.edit',compact('inventory'))->with('mode','create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        Inventory::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('inventory.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
        return view('tansaction.inventory.edit',compact('inventory'))->with('mode','edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, Inventory $inventory)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['changed_by'] = Auth::user()->user_id;

        $inventory->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('inventory.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryRequest $request, Inventory $inventory)
    {
        //
        $inventory = Inventory::withTrashed()->findOrFail($inventory->id);
        if($inventory->trashed()){
            // 削除されている場合はrestore
            $inventory->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            $inventory->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('inventory.index');

    }
}
