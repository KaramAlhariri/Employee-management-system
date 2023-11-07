@extends('layouts.main')


@section('content')

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
    <main>
 <div class="container-fluid px-4">
    <h1 class="mt-4">Create Department</h1>
    <ol class="breadcrumb mb-1">
    </ol>
 </div>

  <div class="container">
    <div class="card-body mb-1">
        @if(Session::has('message'))
                            <div class="alert alert-success">
                             {{ Session::get('message')}}
                             @endif
                            </div>   
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-1">
               
                <div class="card-body">
                    
                    
                    <form method="POST" action="{{ route('department.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" value = ""
                                    name="name" type="text" placeholder="Enter your first name" />
                                    <label for="name">Department name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating mt-0 mb-3 mb-md-0">
                        <select name='city_id' class="form-select p-3 @error('name') is-invalid @enderror" aria-label="Default select example">
                            @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            <option selected>City</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>    
                            @endforeach
                          </select>
                        </div>
                        <div class="mt-2 mb-0">
                            <div class="d-grid"><button class="btn btn-primary btn-block">Create</button></div>
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


