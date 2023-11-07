<?php

namespace App\Http\Controllers\Backend;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Auth::user()->employees->all();
        if($request->has('search')){
           $employees = Employee::where('user_id',Auth::user()->id)
           ->where(function($query)use($request){
               return $query->where('first_name','like',"%{$request->search}%")
               ->orWhere('last_name','like',"%{$request->search}%");
            })->get();
        }
        $s = $request->search;
        return view('employees.index',compact('employees','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('message','Employee was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit',compact('employee','departments'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        
        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'datehired' => $request->datehired,
            'salary' => $request->salary,
            'department_id' => $request->department_id,
            'user_id' => $request->user_id,
         ]);
         return redirect()->route('employees.index')->with('message',"updated successufly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try{
            Employee::destroy($employee->id);
        }catch(Exception $e){
            return redirect()->route('employees.index')->with('message2','failed to delete.'); 
        }
            

        return redirect()->route('employees.index')->with('message','deleted successfully');
    }
    public function export(Request $request) 
    {
        
       if($request->has('pdf')){
        return Excel::download(new EmployeesExport($request), 'Employees.pdf',\Maatwebsite\Excel\Excel::MPDF);
       }else{
        return Excel::download(new EmployeesExport($request), 'Employees.xlsx');
       }
       
       
       return view('exports.employees', [
        'employees' => Employee::all()
    ]);
     
    }
}
