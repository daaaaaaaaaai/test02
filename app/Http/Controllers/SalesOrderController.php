<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SalesOrderHeader;
use App\Models\SalesOrderItem;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Unit;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use App\Http\Requests\Traits\NumberingTrait;


class SalesOrderController extends Controller
{
    use NumberingTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $headers = SalesOrderHeader::where('order_type','SalesOrder')->withTrashed()->paginate(10);
        $title = __('SalesOrder');
        return view('transaction.salesorder.index', compact('headers','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customer = new Customer;
        $materials  = Material::all();
        $header = new SalesOrderHeader;
        $items = new SalesOrderItem;
        $title = '受注';
        return view('transaction.salesorder.edit', compact('header', 'items', 'customer', 'materials','title'))->with('mode', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'cust_id' => 'required|exists:customers,cust_id',
            'order_date'  => 'required|date',
            'materials.*.material_code' => 'required|exists:materials,material_code',
            'materials.*.quantity'   => 'required|double|min:1'
        ]);

        // Header作成
        $salesorder = SalesOrder::create([
            'order_date'  => $request->order_date,
            'cust_id' => $request->cust_id,
            'user_id' => $request->user_id,
        ]);

        // Item作成
        foreach ($request->materials as $material) {
            SalesOrderDetail::create([
                'order_number'   => $salesorder->order_number,
                'product_id' => $material['material_code'],
                'quantity'   => $material['quantity'],
                'unit_price' => $material['unit_price'],
                'net_price' => $material['quantity'] * $material['unit_price']
            ]);
        }
        return redirect()->route('salesorder.index')->with('message', '受注を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(tring $order_number)
    {
        //
        $salesorder = SalesOrder::findOrFail($order_number);
        return view('transaction.sakesorder.show', compact('salesorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $order_number)
    {
        //
        $salesorder = SalesOrder::with('salesorderItems')->findOrFail($order_number);
        $customers = Customer::all();
        $materials = Material::all();
        return view('transaction.salesorder.edit', compact('salesorder', 'customers', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $order_number)
    {
        //
        $request->validate([
            'cust_id' => 'required|exists:customers,cust_id',
            'order_date'  => 'required|date',
            'materials.*.material_code' => 'required|exists:materials,material_code',
            'materials.*.quantity'   => 'required|double|min:1'
        ]);

        // Header更新
        $salesorder = SalesOrder::findOrFail($order_number);
        $order->update([
            'order_date'  => $request->order_date,
            'cust_id' => $request->cust_id,
            'user_id' => $request->user_id,
        ]);

        // 既存のItemを削除して再度作成（簡易実装）
        $salesorder->salesorderItems()->delete();
        foreach ($request->materials as $material) {
            OrderDetail::create([
                'order_number'   => $salesorder->order_number,
                'product_id' => $material['material_code'],
                'quantity'   => $material['quantity'],
                'unit_price' => $material['unit_price'],
                'net_price' => $material['quantity'] * $material['unit_price']
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $order_number)
    {
        //
        $salesorder = SalesOrder::findOrFail($order_number);
        $salesorder->delete();
        return redirect()->route('salesorder.index')->with('message', '受注を削除しました');
    }
}
