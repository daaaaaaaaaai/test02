<?php

namespace App\Http\Controllers\Masters;

use App\Models\Masters\SalesExpense;
use App\Models\Customizes\TypeValue;
//use Illuminate\Http\Request;
use App\Http\Requests\SalesExpenseRequest;

class SalesExpenseController extends Controller
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
        $exps = SalesExpense::withTrashed()->paginate(10);
        $vals03 = TypeValue::where('type','03')->pluck('text', 'value');
        return view('master.salesexpense.index',compact('exps','vals03'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('master.salesexpense.edit')->with('mode', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesExpenseRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        SalesExpense::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('master.salesexpense.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesExpense $salesExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        [$type, $start_date] = explode($sep, $id);

        $exp = SalesExpense::where('type', $type)
                           ->where('satart_date', $start_date)
                           ->firstOrFail();
        $vals03 = TypeValue::where('type','03')->pluck('text', 'value');

        return view('master.salesexpense.edit', compact('exp','vals03'))->with('mode', 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalesExpenseRequest $request, SalesExpense $salesExpense)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        SalesExpense::where('type', $validated['type'])
                    ->where('start_date', $validated['start_date'])
                    ->update([
                        'dlv_pre'            => $validated['dlv_pre'],
                        'weight_tax'         => $validated['weight_tax'],
                        'reg_stamp'          => $validated['reg_stamp'],
                        'license_plate'      => $validated['license_plate'],
                        'license_plate_cost' => $validated['license_plate_cost'],
                        'setup_cost'         => $validated['setup_cost'],
                        'changed_by'         => Auth::user()->user_id,
                    ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('salesexpense.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesExpenseRequest $request, $id)
    {
        //
        [$type, $start_date] = explode($sep, $id);

        $exp = Material::withTrashed()->findOrFail($id);

        $exp = SalesExpense::withTrashed()
                           ->where('type', $type)
                           ->where('start_date', $start_date)
                           ->firstOrFail();

        if($exp->trashed()){
            // 削除されている場合はrestore
            $exp->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            $exp->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('salesexpense.index');
    }
}
