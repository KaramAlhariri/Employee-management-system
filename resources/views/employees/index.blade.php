@extends('layouts.main')

@section('content')
<script>
  function update(){
    var x = document.getElementById('search').value;
    document.getElementById('pdf').value = x;
    document.getElementById('excel').value = x;
  }
  </script>
<div class="container-fluid px-4">
    <h1 class="mt-1">Employees</h1>
    <div class="card-header">
      <div class="headbtn d-flex justify-content-between">
        <form method="GET" action="{{ route('employees.index') }}">
        
          <div class="row">
            <div class="form-row align-items-center">
             <div class="col-auto">
              <div class ="d-inline">
              <input type="search" id="search" value="{{ $s }}" name="search" onchange="update()" class="d-inline form-control mb-2" style="width: 71% !important;" id="inlineFormInput" placeholder="Search User">
              <button type="submit" class="btn btn-primary mb-2">Search</button> 
           </div>
          </div>
        </div>
     </div>
      </form>
    <div>
      <a class="btn btn-success align-right d-inline" href="{{ route('employees.create') }}">Create</a>
      <form method="GET" class='d-inline' action="{{ route('employees.export') }}">
      <button type="submit" class="btn btn-dark "><i class="fa fa-file-pdf" aria-hidden="true"></i></a></button>
      <input type="hidden" value = "{{ $s }}" name="pdf" id="pdf">
      </form>
      
      <form method="GET" class="d-inline" action="{{ route('employees.export') }}">
      <button type="submit"  class="btn btn-dark" href="{{ route('employees.create') }}"><i class="fa fa-file-excel" aria-hidden="true"></i></a></button>
      <input type="hidden" value = "{{ $s }}" name="excel" id="excel">
    </form>
    </div>
      </div>
    
  </div>
    
  

  
    @if(Session::has('message'))
    <div class="alert alert-success">
     {{ Session::get('message')}}
     @endif
    </div>   
    <form>
   
    <table class="table">
      
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Salary</th> 
            <th scope="col">Address</th> 
            <th scope="col">Department</th>
            <th scope="col">City</th> 
            <th scope="col">Country</th> 
            <th scope="col">Manage</th> 
            
            
             
          </tr>
        </thead>
        <tbody>
          @php
            $sum = 0;
          @endphp
         
          @foreach ($employees as $key => $emp)
          <tr>
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $emp->first_name }}</td>
            <td>{{ $emp->last_name }}</td>
            <td>{{ number_format($emp->salary) }}</td>
            <td>{{ $emp->address }}</td>
            <td>{{ $emp->department->name }}
            <td>{{ $emp->department->city->name }}</td>
            <td>{{ $emp->department->city->country->name }}</td>
            <td><a class="btn btn-success" href="{{ route('employees.edit' , $emp->id) }}">edit</a>
              <a class="btn btn-danger" href="{{ route('employees.delete' , $emp->id) }}">delete</a>
          </tr>
          @php
            $sum += (int) $emp->salary;
          @endphp
          
          @endforeach
         
          
        </tbody>
      </table>
      <div class='card-content'>
        
        <p class="card-text text-white bg-success  " style="width: fit-content;"> &nbsp;The summation of shown salaries is {{ number_format($sum) }} &nbsp;</p></div>
@endsection