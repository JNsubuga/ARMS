<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Animalclass;
use App\Models\Gender;
use App\Models\Staffmember;
use Illuminate\Http\Request;
use PDF;

class AnimalsController extends Controller
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
        // $this->middleware('permission:animal-list|animal-create|animal-edit|animal-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:animal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:animal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:animal-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::latest()->filter(request(['search']))->paginate();
        return view('animals.index', ['animals' => $animals]);
        // $request->session()->flash('Susccess', 'Loaded Successfully!!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectAnimalclasses = Animalclass::get(['id', 'className']);
        $selectStaffmembers = Staffmember::get(['id', 'Names']);
        $selectGenders = Gender::get(['id', 'Gender']);
        // dd($selectAnimalclasses);
        return view('animals.create', [
            'selectAnimalclasses' => $selectAnimalclasses,
            'selectStaffmembers' => $selectStaffmembers,
            'selectGenders' => $selectGenders
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
            'animalclass_id' => 'required',
            'staffmember_id' => 'required',
            'maleParent' => 'required',
            'femaleParent' => 'required',
            'gender_id' => 'required',
            'breed' => 'required',
            'DoJ' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        // dd($formFields);
        Animal::create($formFields);

        return redirect(route('animal.index'))->with('success', 'Record Saved Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Animal::where('id', $id)->first();
        return view('animals.show', ['toDetail' => $toDetail]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF($id)
    {
        $toDownloadPdf = Animal::where('id', $id)->first();
        // dd($toDownloadPdf);
        $pdf = PDF::loadView('animals.PDF.animalHealthyHistory', ['toDownloadPdf' => $toDownloadPdf]);
        return $pdf->download(date('Ymd', strtotime(now())) . 'animalHealthyHistory.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Animal::where('id', $id)->first();
        // dd($toUpdate);
        $defaultAnimalclass = Animalclass::where('id', $toUpdate->animalclass_id)->get(['id', 'className']);
        $defaultStaffmember = Staffmember::where('id', $toUpdate->staffmember_id)->get(['id', 'Names']);
        $defaultGender = Gender::where('id', $toUpdate->gender_id)->get(['id', 'Gender']);

        $selectAnimalclasses = Animalclass::get(['id', 'className']);
        $selectStaffmembers = Staffmember::get(['id', 'Names']);
        $selectGenders = Gender::get(['id', 'Gender']);
        // dd($selectAnimalclasses);
        return view('animals.edit', [
            'toUpdate' => $toUpdate,
            'defaultAnimalclass' => $defaultAnimalclass,
            'defaultStaffmember' => $defaultStaffmember,
            'defaultGender' => $defaultGender,

            'selectAnimalclasses' => $selectAnimalclasses,
            'selectStaffmembers' => $selectStaffmembers,
            'selectGenders' => $selectGenders
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fromFields = $request->validate([
            'maleParent' => 'required',
            'femaleParent' => 'required',
            'breed' => 'required',
            'DoJ' => 'required'
        ]);

        Animal::where('id', $id)->update($fromFields);

        return redirect(route('animal.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Animal::destroy($id);

        return redirect(route('animal.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
