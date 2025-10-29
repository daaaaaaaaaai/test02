<?php

namespace App\Http\Controllers\Masters;

use App\Models\Masters\LisencePlateCost;
use Illuminate\Support\Facades\Auth;
use App\Models\Customizes\Prefecture;
//use Illuminate\Http\Request;
use App\Http\Requests\LisencePlateCostRequest;

class LisencePlateCostController extends Controller
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
        //$costs = LisencePlateCost::withTrashed()->paginate(20);
        $costs = LisencePlateCost::withTrashed()->get();
        $prefs=Prefecture::all()->pluck('text', 'prefecture');
        return view('master.lisenceplatecost.index', compact('costs','prefs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cost=new LisencePlateCost;
        $prefs=Prefecture::all()->pluck('text', 'prefecture');
        return view('master.lisenceplatecost.edit', compact('cost','prefs'))->with('mode', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LisencePlateCostRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // その他がNULLの場合空白を埋める
        $validated['pref_etc'] = $validated['pref_etc'] ?? '';

        // ここで保存処理やレスポンス処理を行う
        LisencePlateCost::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('lisenceplatecost.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(LisencePlateCost $lisencePlateCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        [$prefecture, $pref_etc] = explode($sep, $id);

        $cost = LisencePlateCost::where('prefecture', $prefecture)
                                ->where('pref_etc', $pref_etc)
                                ->firstOrFail();
        $prefs=Prefecture::all()->pluck('text', 'prefecture');
        return view('master.lisenceplatecost.edit', compact('cost','prefs'))->with('mode', 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LisencePlateCostRequest $request, LisencePlateCost $lisencePlateCost)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        LisencePlateCost::where('prefecture', $validated['prefecture'])
                        ->where('pref_etc', $validated['pref_etc'])
                        ->update([
                            'purchase_price' => $validated['purchase_price'],
                            'sales_price'    => $validated['sales_price'],
                            'changed_by'     => Auth::user()->user_id,
        ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('lisenceplatecost.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LisencePlateCostRequest $request, $id)
    {
        //
        [$prefecture, $pref_etc] = explode($sep, $id);

        $cost = LisencePlateCost::withTrashed()
                    ->where('prefecture', $prefecture)
                    ->where('pref_etc', $pref_etc)
                    ->firstOrFail();
        //dd($cost);

        if($cost->trashed()){
            // 削除されている場合はrestore
            //$cost->restore();
            LisencePlateCost::onlyTrashed()
                ->where('prefecture', $prefecture)
                ->where('pref_etc', $pref_etc)
                ->restore();
            $request->session()->flash('message','復元しました');
        }else{
            // 有効な場合はsoftdelete
            //$cost->delete();
            LisencePlateCost::where('prefecture', $prefecture)
                ->where('pref_etc', $pref_etc)
                ->delete();
            $request->session()->flash('message','削除しました');
        }

        return redirect()->route('lisenceplatecost.index');
    }
}
