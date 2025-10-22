<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Traits\NumberingTrait;
use App\Models\Masters\Customer;
use App\Models\Masters\Material;
use App\Models\Customizes\Classification;
use App\Models\Customizes\Country;
use App\Models\Customizes\Unit;
use App\Models\Customizes\TaxRate;
use App\Models\Transactions\SalesOrderHeader;
use App\Models\Transactions\SalesOrderItem;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $headers = SalesOrderHeader::where('order_type','Invoice')->withTrashed()->paginate(10);
        $title = __('Invoice');
        return view('transaction.salesorder.index', compact('headers','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
