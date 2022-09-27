<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
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
        // $this->middleware('permission:unit-list|unit-create|unit-edit|unit-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:unit-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:unit-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:unit-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->filter(request(['search']))->paginate();
        return view('units.index', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
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
            'Unit' => 'required',
            'Abbriviation' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        Unit::create($formFields);

        return redirect(route('unit.index'))->with('success', 'Record Stored Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Unit::where('id', $id)->first();

        return view('units.show', ['todetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Unit::where('id', $id)->first();

        return view('units.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Unit' => 'required',
            'Abbriviation' => 'required'
        ]);

        Unit::where('id', $id)->update($formFields);
        return redirect(route('unit.index'))->with('success', 'Record Updted Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::destroy($id);

        return redirect(route('unit.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
