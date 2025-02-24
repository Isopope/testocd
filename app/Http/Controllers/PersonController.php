<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller as BaseController;

class PersonController extends BaseController
{

    // public function __construct(){
    //     $this->middleware('auth')->only(['create', 'store']);
    // }

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people=Person::with('creator')->get();
        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation=$this->inputValidation($request);
        $person=Person::create($validation);
        return redirect()->route('people.index', $person->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $person=Person::with(['creator','parents','children'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    private function inputValidation(Request $request){
        $validation= $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);
        $validation['created_by']=auth()->id;
        $validation['first_name']=ucfirst(strtolower($validation['first_name']));
        $validation['last_name']=strtoupper($validation['last_name']);
        if(!empty($validation['middle_name'])){
            $middle_nameArray=explode(',', $validation['middle_name']);
            $formattedMiddleName=[];
            foreach($middle_nameArray as $name){
                $name=ucfirst(strtolower($name));
                $formattedMiddleName[]=$name;
            }
            $validation['middle_name']=implode(', ', $formattedMiddleName);

        }else{
            $validation['middle_name']=null;
        }
        if($validation['birth_name']){
            $validation['birth_name']=strtoupper($validation['birth_name']);
        }else{
            $validation['birth_name']=$validation['last_name'];
        }
        if($validation['date_of_birth']){
            $validation['date_of_birth']=strtoupper(date('Y-m-d', strtotime($validation['date_of_birth'])));
        }else{
            $validation['date_of_birth']=null;
        }
        return $validation;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
