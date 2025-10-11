<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Prefecture;
//use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\Traits\NumberingTrait;

class CustomerController extends Controller
{
    use NumberingTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = Customer::withTrashed()->paginate(10);
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $prefectures=Prefecture::all();
        $customer=new customer;
        return view('customer.edit',compact('customer','prefectures'))->with('mode','create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['created_by'] = Auth::user()->user_id;
        $validated['changed_by'] = Auth::user()->user_id;

        // 顧客コード未入力時は自動採番
        if(empty($validated['cust_code'])){
            $validated['cust_code']=$this->nextNumber('Customer',10);
        }

        // チェックボックス値
        $validated['line'] = $request->boolean('is_line');

        // ここで保存処理やレスポンス処理を行う
        Customer::create($validated);

        $request->session()->flash('message','登録しました');
        return redirect(route('customer.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        $prefectures=Prefecture::all();
        return view('customer.edit',compact('customer','prefectures'))->with('mode','edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        // FormRequestを通過した後なので、前処理・バリデーション済み
        $validated = $request->validated();

        // テーブル更新者の編集
        $validated['changed_by'] = Auth::user()->user_id;

        // チェックボックス値
        $validated['line'] = $request->boolean('is_line');

        $customer->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect(route('customer.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerRequest $request, $id)
    {
        //
        $customer = Customer::withTrashed()->findOrFail($id);
        if($customer->trashed()){
            // 削除されている場合はrestore
            $customer->restore();
            $request->session()->flash('message','復元しました');
            return redirect()->route('customer.index');
        }else{
            // 有効な場合はsoftdelete
            $customer->delete();
            $request->session()->flash('message','削除しました');
            return redirect()->route('customer.index');
        }
    }
}
