<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpParser\Node\Expr\Cast\Int_;
use Ramsey\Uuid\Type\Integer;

class EmployeesExport implements FromView , ShouldAutoSize , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings() : array
    {
         return $this->headings; //english
    }    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->headings = $request->sal;
    }

    // public function collection()
    // {
    //     $employees = Employee::select('first_name', 'last_name',)
    //     ->where('user_id', '=', Auth::user()->id)
    //     ->get();
       
    //     return collect([['first name','last name'],$employees]);
    // }
 

    public function view(): View
    {
        $employees = Auth::user()->employees->all();
        $req= null;
        
        if($this->request->has('pdf')){
           $req = $this->request->pdf;
        }else if($this->request->has('excel')){
            $req = $this->request->excel;
        }

        if($req != null){
            $employees = Employee::where('user_id',Auth::user()->id)
            ->where(function($query)use($req){
                return $query->where('first_name','like',"%{$req}%")->orWhere('last_name','like',"%{$req}%");
             })->get();
        }
        
     return view('exports.employees', [
         'employees' =>$employees
     ]);
}
}