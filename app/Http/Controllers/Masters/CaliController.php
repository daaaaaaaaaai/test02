<?php

namespace App\Http\Controllers\Masters;

use App\Models\Masters\Cali;
use App\Models\Customizes\TypeValue;
//use Illuminate\Http\Request;
use App\Http\Requests\CaliRequest;

class CaliController extends Controller
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
        $calis = Cali::withTrashed()->paginate(10);
        $vals04 = TypeValue::where('type','04')->pluck('text', 'value');
        return view('master.cali.index',compact('calis','vals04'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('master.cali.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaliRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        Cali::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('master.cali.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cali $cali)
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

        $cali = Cali::where('type', $type)
                    ->where('satart_date', $start_date)
                    ->firstOrFail();

        $vals04 = TypeValue::where('type','04')->pluck('text', 'value');
        return view('master.cali.edit', compact('cali','vals04'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaliRequest $request, Cali $cali)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        Cali::where('type', $validated['type'])
            ->where('start_date', $validated['start_date'])
            ->update([
                'month_00'    => $validated['month_00'],
                'month_12'    => $validated['month_12'],
                'month_24'    => $validated['month_24'],
                'month_25'    => $validated['month_25'],
                'month_36'    => $validated['month_36'],
                'month_37'    => $validated['month_37'],
                'month_48'    => $validated['month_48'],
                'month_60'    => $validated['month_60'],
                'month_99'    => $validated['month_99'],
                'receipt_fee' => $validated['receipt_fee'],
                'changed_by'  => Auth::user()->user_id,
        ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('cali.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaliRequest $request, $id)
    {
        //
        [$type, $start_date] = explode($sep, $id);

        $cali = Cali::withTrashed()
                    ->where('type', $type)
                    ->where('start_date', $start_date)
                    ->firstOrFail();

        if($cali->trashed()){
            // 削除されている場合はrestore
            $cali->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            $cali->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('cali.index');
    }
}
