<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GendersController extends Controller
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
        // $this->middleware('permission:gender-list|gender-create|gender-edit|gender-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:gender-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gender-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gender-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::latest()->filter(request(['search']))->paginate();
        return view('genders.index', ['genders' => $genders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genders.create');
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
            'Gender' => 'required'
        ]);
        // $formFields['user_id'] = auth()->user()->id;
        switch ($formFields['Gender']) {
            case 'Female':
                return redirect(route('gender.index'))->with('error', 'Gender ' . $formFields['Gender'] . ' already exists!!');
                break;
            case 'Male':
                return redirect(route('gender.index'))->with('error', 'Gender ' . $formFields['Gender'] . ' already exists!!');
                break;
            default:
                return redirect(route('gender.index'))->with('error', 'Gender ' . $formFields['Gender'] . ' does not exists!!');
                break;
        }
        // if ($formFields['Gender'] === 'Male') {
        //     return redirect(route('gender.index'))->with('error', 'Gender' . $formFields['Gender'] . 'already exists!!');
        // } elseif ($formFields['Gender'] === 'Female') {
        //     return redirect(route('gender.index'))->with('error', 'Gender' . $formFields['Gender'] . 'already exists!!');
        // }
        // Gender::create($formFields);

        // return redirect(route('gender.index'))->with('success', 'Record Saved Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Gender::where('id', $id)->first();

        return view('genders.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Gender::where('id', $id)->first();
        // dd($toUpdate);
        return view('genders.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Gender' => 'required'
        ]);

        Gender::where('id', $id)->update($formFields);
        return redirect(route('gender.index'))->with('success', 'Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gender::destroy($id);
        return redirect(route('gender.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
