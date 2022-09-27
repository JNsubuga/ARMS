<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Sale;
use App\Models\Unit;
use App\Models\Stock;
use App\Models\Bincard;

use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
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
        // $this->middleware('permission:sale-list|sale-create|sale-edit|sale-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:sale-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sale-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->filter(request(['search']))->paginate();
        // $this->downloadPDF($sales);
        return view('sales.index', ['sales' => $sales]);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function downloadPDF(array $array)
    public function downloadPDF()
    {
        // dd(request($sales));
        $salesData = Sale::get();
        // dd($salesData);
        // $pdfOutput = [
        //     'Title' => 'Sales List',
        //     'Date' => date('d/m/Y'),
        //     'sales' => $salesData
        // ];
        // $pdf = PDF::loadView('sales.downloadSalesPdf', $pdfOutput);
        $pdf = PDF::loadView('sales.PDF.downloadSalesPdf', ['sales' => $salesData]);
        return $pdf->download(date('Ymd', strtotime(now())) . 'SalesList.pdf');
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
        return view('sales.create', ['selectProducts' => $selectProducts, 'selectUnits' => $selectUnits]);
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
        $formFields['user_id'] = auth()->user()->id;
        $checkPresence = Stock::where('product_id', $formFields['product_id'])->first();
        $productName = Product::where('id', $checkPresence->product_id)->first(['Name']);
        if ($checkPresence['Quantity'] >= $formFields['Quantity']) {
            $checkPresence['Quantity'] = $checkPresence['Quantity'] - $formFields['Quantity'];
            $updateFields = [
                'product_id' => $checkPresence->product_id,
                'Quantity' => $checkPresence->Quantity,
                'unit_id' => $checkPresence->unit_id
            ];
            $addToBincard = [
                'user_id' => $formFields['user_id'],
                'product_id' => $formFields['product_id'],
                'receivedQuantity' => 0,
                'soldQuantity' => $formFields['Quantity'],
                'stockQuantity' => $checkPresence['Quantity'],
                'unit_id' => $formFields['unit_id']
            ];


            // if ($checkPresence['Quantity'] >= 0) {
            //     Sale::create($formFields);
            //     Stock::where('id', $checkPresence->id)->update($updateFields);
            // } else {
            //     return redirect(route('sale.index'))->with('error', 'We only have _______ Quantity of ______ in Stock');
            // } 

            Bincard::create($addToBincard);
            Sale::create($formFields);
            Stock::where('id', $checkPresence->id)->update($updateFields);

            return redirect(route('sale.index'))->with('success', 'Record Saved Successfully');
        } else {
            return redirect(route('sale.index'))->with('error', 'We only have ' . $checkPresence['Quantity'] . ' Quantity of ' . $productName->Name . ' in Stock');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Download the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // public function downloadPDF($id)
    // {
    //     $sale = Sale::find($id);

    //     $pdf = PDF::loadView('sales.downloadSalesPdf', ['sale' => $sale]);

    //     return $pdf->download(date('Ymd', strtotime(now())) . 'Sales.pdf');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
