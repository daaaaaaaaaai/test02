<?php

namespace App\Http\Controllers\Masters;

use App\Models\Masters\SuzukiData;
//use Illuminate\Http\Request;
use App\Http\Requests\SuzukiDataRequest;

class SuzukiDataController extends Controller
{
    // Controller内の共通変数
    private $sep;

    public function __construct()
    {
        $this->sep = config('id_separator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = SuzukiData::withTrashed()
                            ->selectRaw('start_date, MAX(created_at) as created_at, MAX(updated_at) as updated_at, MAX(deleted_at) as deleted_at')
                            ->groupBy('start_date')
                            ->paginate(10);
        return view('master.suzukidata.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('master.suzukidata.edit')->with('mode', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SuzukiDataRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        SuzukiData::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('suzukidata.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SuzukiData $SuzukiData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($start_date)
    {
        //
        $datas = SuzukiData::where('start_date', $start_date)->get();
 
        return view('master.suzukidata.edit', compact('datas'))->with('mode', 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuzukiDataRequest $request, $start_date)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        SuzukiData::where('start_date', $start_date)
                  ->update([
                        'type'                  => $validated['type'],
                        'material_code'         => $validated['material_code'],
                        'material_name'         => $validated['material_name'],
                        'maker_price'           => $validated['maker_price'],
                        'response_rate'         => $validated['response_rate'],
                        'basic_margin'          => $validated['basic_margin'],
                        'special_margin'        => $validated['special_margin'],
                        'gross_price'           => $validated['gross_price'],
                        'gross_amount'          => $validated['gross_amount'],
                        'unit_price'            => $validated['unit_price'],
                        'dlv_pre'               => $validated['dlv_pre'],
                        'weight_tax'            => $validated['weight_tax'],
                        'reg_stamp'             => $validated['reg_stamp'],
                        'license_plate'         => $validated['license_plate'],
                        'cali'                  => $validated['cali'],
                        'starting_price'        => $validated['starting_price'],
                        'profit'                => $validated['profit'],
                        'profit_rate'           => $validated['profit_rate'],
                        'moto_cost_incl_tax'    => $validated['moto_cost_incl_tax'],
                        'int_weight_tax'        => $validated['int_weight_tax'],
                        'int_reg_stamp'         => $validated['int_reg_stamp'],
                        'int_license_plate'     => $validated['int_license_plate'],
                        'int_cali'              => $validated['int_cali'],
                        'cost_amount'           => $validated['cost_amount'],
                        'type_dlv'              => $validated['type_dlv'],
                        'type_cali'             => $validated['type_cali'],
                        'type_theft'            => $validated['type_theft'],
                        'type_cr1_1'            => $validated['type_cr1_1'],
                        'type_cr1_2'            => $validated['type_cr1_2'],
                        'type_zr_ext'           => $validated['type_zr_ext'],
                        'type_zr_moto'          => $validated['type_zr_moto'],
                        'type_store'            => $validated['type_store'],
                        'color_code01'          => $validated['color_code01'],
                        'color_code02'          => $validated['color_code02'],
                        'color_code03'          => $validated['color_code03'],
                        'color_code04'          => $validated['color_code04'],
                        'color_code05'          => $validated['color_code05'],
                        'color_name01'          => $validated['color_name01'],
                        'color_name02'          => $validated['color_name02'],
                        'color_name03'          => $validated['color_name03'],
                        'color_name04'          => $validated['color_name04'],
                        'color_name05'          => $validated['color_name05'],
                        'text_material'         => $validated['text_material'],
                        'remarks_material'      => $validated['remarks_material'],
                        'response_code'         => $validated['response_code'],
                        'tax_code'              => $validated['tax_code'],
                        'changed_by'            => Auth::user()->user_id,
                    ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('suzukidata.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuzukiDataRequest $request, $start_date)
    {
        //
        $data = SuzukiData::withTrashed()
                          ->where('start_date', $start_date)
                          ->firstOrFail();

        if($data->trashed()){
            // 削除されている場合はrestore
            $data->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            $data->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('suzukidata.index');
    }
}
