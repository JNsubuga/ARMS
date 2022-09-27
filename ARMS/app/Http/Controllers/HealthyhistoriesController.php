<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Healthyhistory;
use App\Models\Vetdoctor;
use Illuminate\Http\Request;
use PDF;

class HealthyhistoriesController extends Controller
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
        // $this->middleware('permission:healthy-history-list|healthy-history-create|healthy-history-edit|healthy-history-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:healthy-history-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:healthy-history-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:healthy-history-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthyhistories = Healthyhistory::latest()->filter(request(['search']))->paginate(50);

        return view('healthyhistories.index', ['healthyhistories' => $healthyhistories]);
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
        $healthyHistoryData = Healthyhistory::get();
        // dd($healthyHistoryData);
        // $pdfOutput = [
        //     'Title' => 'Sales List',
        //     'Date' => date('d/m/Y'),
        //     'sales' => $healthyHistoryData
        // ];
        // $pdf = PDF::loadView('sales.downloadSalesPdf', $pdfOutput);
        $pdf = PDF::loadView('healthyhistories.PDF.downloadHhPdf', ['toDownloadPdfHealthyhistories' => $healthyHistoryData]);
        return $pdf->download(date('Ymd', strtotime(now())) . 'HealthyHistoryList.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectAnimals = Animal::get(['id', 'DoJ']);
        $selectVetdoctors = Vetdoctor::get(['id', 'Names']);

        return view('healthyhistories.create', [
            'selectAnimals' => $selectAnimals,
            'selectVetdoctors' => $selectVetdoctors
        ]);
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
            'animal_id' => 'required',
            'vetdoctor_id' => 'required',
            'Daignosis' => 'required',
            'Treatment' => 'required',
            'Recommendation' => 'required',
            'DoR' => 'nullable'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        // dd($formFields);
        Healthyhistory::create($formFields);

        return redirect(route('healthyhistory.index'))->with('success', 'Record Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Healthyhistory  $healthyhistory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Healthyhistory::where('id', $id)->first();

        return view('healthyhistories.show', ['toDetail' => $toDetail]);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Healthyhistory  $healthyhistory
    //  * @return \Illuminate\Http\Response
    //  */
    // public function downloadPDF($id)
    // {
    //     $toDetail = Healthyhistory::where('id', $id)->first();

    //     return view('healthyhistories.show', ['toDetail' => $toDetail]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Healthyhistory  $healthyhistory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Healthyhistory::where('id', $id)->first();

        $defaultAnimal = Animal::where('id', $toUpdate->animal_id)->first(['id', 'DoJ']);
        // dd($defaultAnimal);
        // dd($toUpdate);
        $defaultVetdoctor = Vetdoctor::where('id', $toUpdate->vetdoctor_id)->first(['id', 'Names']);

        $selectAnimals = Animal::get(['id', 'DoJ']);
        $selectVetdoctors = Vetdoctor::get(['id', 'Names']);

        return view('healthyhistories.edit', [
            'toUpdate' => $toUpdate,
            'defaultAnimal' => $defaultAnimal,
            'defaultVetdoctor' => $defaultVetdoctor,
            'selectAnimals' => $selectAnimals,
            'selectVetdoctors' => $selectVetdoctors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Healthyhistory  $healthyhistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Daignosis' => 'required',
            'Treatment' => 'required',
            'Recommendation' => 'required'
        ]);

        Healthyhistory::where('id', $id)->update($formFields);

        return redirect(route('healthyhistory.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Healthyhistory  $healthyhistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Healthyhistory::destroy($id);

        return redirect(route('healthyhistory.index'))->wiht('success', 'Record Deleted Successfully!!');
    }
}
