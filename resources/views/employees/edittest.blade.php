@extends('layouts.main')


@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  <script>
    let $cities;
    function changedCountry(){
        var select = document.getElementById('city_id'); 
        var id = document.getElementById('country_id').value;
        while (select.firstChild) {
    select.removeChild(select.lastChild);
  }
        document.getElementById('citiesSelect').hidden=false;
        $.ajax({
      type: "GET",
      dataType: "json",
      url: "http://127.0.0.1:8000/api/city/"+id,
      success: function(data) {
      data.forEach(element => {
        var option = document.createElement("option");
        option.text = element.name;
        option.value =  element.country_id;
        option.class = 'city';
            document.getElementById('city_id').appendChild(option);
        });
      }
    });
  
        
    }
    </script>

  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
    <main>
 <div class="container-fluid px-4">
    <h1 class="mt-4">Edit Employee</h1>
    <ol class="breadcrumb mb-1">
    </ol>
 </div>
<div class="card-body mb-1">
    @if(Session::has('message'))
    <div class="alert alert-success">
     {{ Session::get('message')}}
     @endif
    </div>   
  <div class="container">
    
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-1">
               
                <div class="card-body">
                    
                    
                    <form method="POST" action="{{ route('employees.update' ,$employee->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" value = "{{ $employee->first_name }}"
                                    name="first_name" type="text" placeholder="Enter your first name" />
                                    <label for="first_name">first name</label>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" value = "{{ $employee->last_name }}"
                                    name="last_name" type="text" placeholder="Enter your first name" />
                                    <label for="last_name">last name</label>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('salary') is-invalid @enderror" id="salary" value = "{{ $employee->salary }}"
                                    name="salary" type="text" placeholder="Enter your first name" />
                                    <label for="salary">Salary</label>
                                    @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('address') is-invalid @enderror" id="address" value = "{{ $employee->address }}"
                                    name="address" type="text" placeholder="Enter your first name" />
                                    <label for="address">Address</label>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="{{ Auth::User()->id }}" name="user_id" id="user_id">
                        <div class="row mb-3">
                            <div class="form-floating mt-0 mb-3 mb-md-0">
                         <select onChange=' changedCountry() ' id = 'country_id' name='country_id' class="form-select p-3 @error('department_id') is-invalid @enderror" aria-label="Default select example">
                            <label for="department_id">Department</label>
                            @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            <option selected>Country</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $employee->department->city->country->id == $country->id ? "selected" : "" }} >{{ $country->name }} </option>    
                            @endforeach
                          </select>
                        </div>
                    </div>
                        <div id='citiesSelect' hidden='true' class="row mb-3">
                            <div class="form-floating mt-0 mb-3 mb-md-0">
                         <select onChange=' changedCountry() ' id='city_id' name='city_id' class="form-select p-3 @error('department_id') is-invalid @enderror" aria-label="Default select example">
                            <label for="city_id">City</label>
                            @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                          </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating mb-3 mb-md-0">
                            <input placeholder="birthdate" name="birthdate" autocomplete="false" id="birthdate" value="{{ $employee->birthdate }}" class="date form-control @error('birthdate') is-invalid @enderror" type="text">
                            <label for="birthdate">birthdate</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating mb-3 mb-md-0">
                        <input placeholder="datehired" id = "datehired" name="datehired" value="{{ $employee->datehired }}"class="date form-control @error('datehired') is-invalid @enderror" type="text">
                        <label for="datehired">datehired</label>
                    </div>
                </div>
            </div>
                        
                          
                        
                        <script type="text/javascript">
                        
                            $('.date').datepicker({  
                        
                               format: 'yyyy-mm-dd'
                        
                             });  
                        
                        </script> 
                        <div class="mt-2 mb-0">
                            <div class="d-grid"><button class="btn btn-primary btn-block">edit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>
    @endsection


