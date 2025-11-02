<?php

namespace App\Http\Controllers\Customizes;

use App\Http\Controllers\Controller;
use App\Models\Customizes\StatusValue;
use App\Models\Customizes\Status;
use Illuminate\Http\Request;

class StatusValueController extends Controller
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
        $values=StatusValue::all();
        $stats=Status::all()->pluck('text','status');
        return view('customize.statusvalue.index',compact('values','stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.statusvalue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        StatusValue::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.statusvalue.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusValue $statusValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        [$status, $value] = explode($sep, $id);

        $value = StatusValue::where('status', $status)
                            ->where('value', $value)
                            ->firstOrFail();
        $stats=Status::all()->pluck('text','status');

        return view('customize.statusvalue.edit', compact('value','stats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusValue $statusValue)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        StatusValue::where('status', $validated['status'])
                   ->where('value', $validated['value'])
                   ->update([
                      'text'       => $validated['text'],
                      'changed_by' => Auth::user()->user_id,
        ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('statusvalue.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusValue $statusValue, $id)
    {
        //
        [$status, $value] = explode($sep, $id);

        StatusValue::where('status', $status)
                   ->where('value', $value)
                   ->delete();

        $request->session()->flash('message','削除しました');
        return redirect()->route('statusvalue.index');
    }
}
