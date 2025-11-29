<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = \App\Models\Patient::latest()->paginate(10);    
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no' => 'required|unique:patients,no',
            'name' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
            'address' => 'required',
        ]);

        \App\Models\Patient::create($validated);
        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }


    public function edit($id)
    {
        $patient = \App\Models\Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = \App\Models\Patient::findOrFail($id);

        $validated = $request->validate([
            'no' => 'required|unique:patients,no,' . $patient->id,
            'name' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
            'address' => 'required',
        ]);     
        $patient->update($validated);
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }  

    public function destroy($id)
    {
        $patient = \App\Models\Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
