<?php

namespace App\Http\Controllers;

use App\Models\Animalclass;
use App\Models\Staffmember;
use Illuminate\Http\Request;

class StaffmembersController extends Controller
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
        // $this->middleware('permission:staff-member-list|staff-member-create|staff-member-edit|staff-member-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:staff-member-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:staff-member-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:staff-member-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffmembers = Staffmember::latest()->filter(request(['search']))->paginate();

        return view('staffmembers.index', ['staffmembers' => $staffmembers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectAnimalclasses = Animalclass::get(['id', 'section']);

        return view('staffmembers.create', ['selectAnimalclasses' => $selectAnimalclasses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'animalclass_id' => 'required',
            'Names' => 'required',
            'DoB' => 'required',
            'NoK' => 'required',
            'Address' => 'required',
            'PoB' => 'required',
            'title' => 'required',
            'Qualification' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;
        Staffmember::create($formFields);

        return redirect(route('staffmember.index'))->with('success', 'Record Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staffmember  $staffmember
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Staffmember::where('id', $id)->first();
        dd($toDetail);
        return view('staffmembers.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staffmember  $staffmember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Staffmember::where('id', $id)->first();

        $defaultSelect = Animalclass::where('id', $toUpdate->animalclass_id)->first()->get(['id', 'section']);
        $selectAnimalclasses = Animalclass::get(['id', 'section']);
        return view('staffmembers.edit', [
            'toUpdate' => $toUpdate,
            'defaultSelect' => $defaultSelect,
            'selectAnimalclasses' => $selectAnimalclasses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staffmember  $staffmember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            // 'animalclass_id' => 'required',
            'Names' => 'required',
            'DoB' => 'required',
            'NoK' => 'required',
            'Address' => 'required',
            'PoB' => 'required',
            'title' => 'required',
            'Qualification' => 'required'
        ]);

        Staffmember::where('id', $id)->update($formFields);

        return redirect(route('staffmember.index'))->with('success', 'Reocord Updated Successfuly!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staffmember  $staffmember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staffmember::destroy($id);
        return redirect(route('staffmember.index'))->with('success', 'Record Deleted Successfully!!');
    }
}
