<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryCreateRequest;
use App\Models\Country;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::all();
        return view('countries.index',compact('countries'));
    }
    public function update(Request $request, Country $country){
        $country->update([
           'name' => $request->name
        ]);
        return redirect()->route('country.index')->with('message',"updated successufly");
    }
    public function edit(Country $country){
        return view('countries.edit',compact('country'));
    }
    public function destroy(Country $country){
        try{
            Country::destroy($country->id);
        }catch(Exception $e){
            return redirect()->route('country.index')->with('message2','failed to delete some of the employees still work at our branch there.'); 
        }
            

        return redirect()->route('country.index')->with('message','deleted successfully');
    }

    public function show(){
        return "wtf";
    }

    public function store(CountryCreateRequest $request , Country $country){
        Country::create($request->validated());
        return redirect()->route('country.index')->with('message','city created successfully');
    }
    public function create()
    {
        return view('countries.create');
    }
}
