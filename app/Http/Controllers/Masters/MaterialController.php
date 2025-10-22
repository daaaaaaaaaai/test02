<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Material;
use App\Models\Customizes\Classification;
use App\Models\Customizes\Country;
use App\Models\Customizes\Unit;
use App\Models\Customizes\Color;
use App\Models\Customizes\Type;
use App\Models\Customizes\TypeValue;
//use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\Traits\NumberingTrait;

class MaterialController extends Controller
{
    use NumberingTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$materials = Material::all();
        $materials = Material::withTrashed()->paginate(10);
        return view('master.material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $material=new Material;
        $classes=Classification::all();
        $countries=Country::all();
        $units=Unit::all();
        $colors=Color::all();
        $payment_types=TypeValue::where('type','05')->get();
        $cali_types=TypeValue::where('type','04')->get();
        $theft_types=TypeValue::where('type','06')->get();
        $cr1_types1=TypeValue::where('type','07')->get();
        $cr1_types2=TypeValue::where('type','08')->get();
        $zrex_types=TypeValue::where('type','09')->get();
        $zrmt_types=TypeValue::where('type','10')->get();
        return view('master.material.edit',
               compact('material','classes','countries','units','colors',
                       'payment_types','cali_types','theft_types','cr1_types1','cr1_types2','zrex_types','zrmt_types'))
             ->with('mode', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // 商品コード未入力時は自動採番
        if(empty($validated['material_code'])){
            $validated['material_code']=$this->nextNumber('Material',18);
        }

        // ここで保存処理やレスポンス処理を行う
        Material::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('material.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        // 画面共通化
        //return view('material.edit', compact('material'))->with('mode', 'edit');
        $classes=Classification::all();
        $countries=Country::all();
        $units=Unit::all();
        $colors=Color::all();
        $payment_types=TypeValue::where('type','05')->get();
        $cali_types=TypeValue::where('type','04')->get();
        $theft_types=TypeValue::where('type','06')->get();
        $cr1_types1=TypeValue::where('type','07')->get();
        $cr1_types2=TypeValue::where('type','08')->get();
        $zrex_types=TypeValue::where('type','09')->get();
        $zrmt_types=TypeValue::where('type','10')->get();
        return view('master.material.edit',
               compact('material','classes','countries','units','colors',
                       'payment_types','cali_types','theft_types','cr1_types1','cr1_types2','zrex_types','zrmt_types'))
             ->with('mode', 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, Material $material)
    {
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['changed_by'] = Auth::user()->user_id;

        $material->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('material.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialRequest $request, $id)
    {
        //
        //dd($material);
        $material = Material::withTrashed()->findOrFail($id);
        
        if($material->trashed()){
            // 削除されている場合はrestore
            $material->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            $material->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('material.index');
    }
}
