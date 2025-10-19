<?php

namespace App\Http\Controllers;

use App\Models\TypeValue;
//use Illuminate\Http\Request;
use App\Http\Requests\TypeValueRequest;

class TypeValueController extends Controller
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
        $values=TypeValue::paginate(10);
        return view('customize.typevalue.index',compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customize.typevalue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeValueRequest $request)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // ここで保存処理やレスポンス処理を行う
        TypeValue::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('customize.typevalue.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeValue $typevalue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        [$type, $value] = explode($sep, $id);

        $value = TypeValue::where('type', $type)
                          ->where('value', $value)
                          ->firstOrFail();

        return view('customize.typevalue.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeValueRequest $request, TypeValue $value)
    {
        //
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // 複合キーになるため更新方法が違う
        TypeValue::where('type', $validated['type'])
                 ->where('value', $validated['value'])
                 ->update([
                    'text'       => $validated['text'],
                    'changed_by' => Auth::user()->user_id,
        ]);

        $request->session()->flash('message','更新しました');
        return redirect(route('typevalue.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeValueRequest $request, $id)
    {
        //
        [$type, $value] = explode($sep, $id);

        $value = TypeValue::where('type', $type)
                          ->where('value', $value)
                          ->firstOrFail();

        TypeValue::where('type', $type)
                 ->where('value', $value)
                 ->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('typevalue.index');
    }
}
