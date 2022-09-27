<?php

namespace App\Http\Controllers;

use App\Models\Bincard;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Guards Resources Against Unauthorised Access.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'destroy']);
        // function __construct()
        // $this->middleware('permission:stock-list|stock-create|stock-edit|stock-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:stock-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stock-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:stock-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::latest()->filter(request(['search']))->paginate();
        return view('stocks.index', ['stocks' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectProducts = Product::get(['id', 'Name']);
        $selectUnits = Unit::get(['id', 'Abbriviation']);
        return view('stocks.create', ['selectProducts' => $selectProducts, 'selectUnits' => $selectUnits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'product_id' => 'required',
            'Quantity' => 'required',
            'unit_id' => 'required'
        ]);
        // dd($formFields['product_id']);
        $formFields['user_id'] = auth()->user()->id;
        $checkPresence = Stock::where('product_id', $formFields['product_id'])->first();
        if (empty($checkPresence)) {
            $addToBincard = [
                'user_id' => $formFields['user_id'],
                'product_id' => $formFields['product_id'],
                'receivedQuantity' => $formFields['Quantity'],
                'soldQuantity' => 0,
                'stockQuantity' => $formFields['Quantity'],
                'unit_id' => $formFields['unit_id']
            ];
            Bincard::create($addToBincard);
            Stock::create($formFields);
            return redirect(route('stock.index'))->with('success', 'Record Stored Successfully!!');
        } else {
            $checkPresence['Quantity'] = $checkPresence['Quantity'] + $formFields['Quantity'];
            $checkPresenceId = $checkPresence->id;
            // dd($checkPresence);
            $updateFields = [
                'product_id' => $checkPresence->product_id,
                'Quantity' => $checkPresence->Quantity,
                'unit_id' => $checkPresence->unit_id
            ];
            $addToBincard = [
                'user_id' => $formFields['user_id'],
                'product_id' => $formFields['product_id'],
                'receivedQuantity' => $formFields['Quantity'],
                'soldQuantity' => 0,
                'stockQuantity' => $checkPresence['Quantity'],
                'unit_id' => $formFields['unit_id']
            ];
            Bincard::create($addToBincard);
            Stock::where('id', $checkPresenceId)->update($updateFields);
            return redirect(route('stock.index'))->with('success', 'Record Stored Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Stock::where('id', $id)->first();

        return view('stocks.show', [
            'toDetail' => $toDetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Stock::where('id', $id)->first();

        $defaultProduct = Product::where('id', $toUpdate->product_id)->first(['id', 'Name']);
        $defaultUnit = Unit::where('id', $toUpdate->unit_id)->first(['id', 'Abbriviation']);

        $selectProducts = Product::get(['id', 'Name']);
        $selectUnits = Unit::get(['id', 'Abbriviation']);

        return view('stocks.edit', [
            'toUpdate' => $toUpdate,

            'defaultProduct' => $defaultProduct,
            'defaultUnit' => $defaultUnit,

            'selectProducts' => $selectProducts,
            'selectUnits' => $selectUnits
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Quantity' => 'required'
        ]);

        Stock::where('id', $id)->update($formFields);

        return redirect(route('stock.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::destroy($id);

        return redirect(route('stock.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
