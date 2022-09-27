<?php

namespace App\Http\Controllers;

use App\Models\Animalclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalclassesController extends Controller
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
        // $this->middleware('permission:animal-type-list|animal-type-create|animal-type-edit|animal-type-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:animal-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:animal-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:animal-type-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animalclasses = Animalclass::latest()->filter(request(['search']))->paginate();
        return view('animalclasses.index', ['animalclasses' => $animalclasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animalclasses.create');
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
            'className' => 'required',
            'section' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        // dd($formFields);
        Animalclass::create($formFields);

        return redirect(route('animalclass.index'))->with('success', 'Record Saved Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animalclass  $animalclass
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Animalclass::where('id', $id)->first();

        return view('animalclasses.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animalclass  $animalclass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Animalclass::where('id', $id)->first();

        return view('animalclasses.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animalclass  $animalclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'className' => 'required',
            'section' => 'required'
        ]);

        Animalclass::where('id', $id)->update($formFields);

        return redirect(route('animalclass.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animalclass  $animalclass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Animalclass::destroy($id);

        return redirect(route('animalclass.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
