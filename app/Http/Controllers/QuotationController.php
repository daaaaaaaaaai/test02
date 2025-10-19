<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Traits\NumberingTrait;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Unit;
use App\Models\TaxRate;
use App\Models\SalesOrderHeader;
use App\Models\SalesOrderItem;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $headers = SalesOrderHeader::where('order_type','Quotation')->withTrashed()->paginate(10);
        $title = __('Quotation');
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
    public function show(SalesOrderHeader $salesOrderHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrderHeader $salesOrderHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrderHeader $salesOrderHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrderHeader $salesOrderHeader)
    {
        //
    }
}
