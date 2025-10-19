<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Material;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Unit;
use App\Models\TaxRate;
use App\Models\ResponseRate;
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
        $materials=[];
        $classifications=Classification::all();
        $countries=Country::all();
        $units=Unit::all();
        $taxs=TaxRate::whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->get();
        $response_rates=ResponseRate::all();
        $material=new Material;
        return view('master.material.edit', compact('material','classifications','countries','units','taxs','response_rates'))->with('mode', 'create');
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

        // リストボックスの選択値の編集
        $validated['response_rate'] = ResponseRate::findOrFail($validated->response_code);
        $validated['tax_rate'] = TaxRate::findOrFail($validated->tax_code);

        // 商品コード未入力時は自動採番
        if(empty($validated['material_code'])){
            $validated['master.material_code']=$this->nextNumber('Material',18);
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
        $classifications=Classification::all();
        $countries=Country::all();
        $units=Unit::all();
        $taxs=TaxRate::whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->get();
        $response_rates=ResponseRate::whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->get();
        return view('master.material.edit', compact('material','classifications','countries','units','taxs','response_rates'))->with('mode', 'edit');
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

        // リストボックスの選択値の編集
        $res = ResponseRate::findOrFail($validated['response_code']);
        $tax = TaxRate::findOrFail($validated['tax_code']);
        $validated['response_rate'] = $res->response_rate;
        $validated['tax_rate'] = $tax->tax_rate;

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
