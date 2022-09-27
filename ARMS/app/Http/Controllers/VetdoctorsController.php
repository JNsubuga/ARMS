<?php

namespace App\Http\Controllers;

use App\Models\Vetdoctor;
use Illuminate\Http\Request;

class VetdoctorsController extends Controller
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
        // $this->middleware('permission:vet-doctor-list|vet-doctor-create|vet-doctor-edit|vet-doctor-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:vet-doctor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vet-doctor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vet-doctor-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vetdoctors = Vetdoctor::latest()->filter(request(['search']))->paginate();
        return view('vetdoctors.index', ['vetdoctors' => $vetdoctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vetdoctors.create');
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
            'Names' => 'required',
            'speciality' => 'required',
            'job_status' => 'required',
            'Address' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        Vetdoctor::create($formFields);

        return redirect(route('vetdoctor.index'))->with('success', 'Record Stored Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vetdoctor  $vetdoctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Vetdoctor::where('id', $id)->first();

        return view('vetdoctors.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vetdoctor  $vetdoctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Vetdoctor::where('id', $id)->first();

        return view('vetdoctors.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vetdoctor  $vetdoctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Names' => 'required',
            'speciality' => 'required',
            'Address' => 'required'
        ]);

        Vetdoctor::where('id', $id)->update($formFields);

        return redirect(route('vetdoctor.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vetdoctor  $vetdoctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vetdoctor::destroy($id);

        return redirect(route('vetdoctor.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
