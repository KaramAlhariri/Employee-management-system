@extends('layouts.main')
@section('content')

             <div class="container-fluid px-4">
                <h1 class="mt-4">User settings</h1>
                <ol class="breadcrumb mb-1">
                </ol>
             
              <div class="container">
                <div class="card-body mb-1">
                    @if(Session::has('message'))
                                        <div class="alert alert-success">
                                         {{ Session::get('message')}}
                                         @endif
                                        </div>   
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg">        
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update' ,Auth::user()->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input disabled = "true" class="form-control @error('username') is-invalid @enderror" id="username" value = "{{ Auth::user()->username }}"
                                                name="username" type="text" placeholder="Enter your first name" />
                                                <label for="username">Username</label>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input   value = "{{ Auth::user()->first_name }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" type="text" placeholder="Enter your last name" />
                                                <label for="first_name">First name</label>
                                                @error('first_name')
                                 <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input  value = "{{ Auth::user()->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" type="text" placeholder="Enter your last name" />
                                                <label for="last_name">Last name</label>
                                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                       </span>
                                 @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input  value = "{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Enter your last name" />
                                                <label for="email">Email Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0">
                                        <div class="d-grid"><button class="btn btn-primary btn-block">Edit Settings</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="card-body mb-0">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.updatepw',Auth::user()->id) }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-1 mb-md-0">
                                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" autocomplete="new-password" />
                                                <label for="password">Password</label>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" />
                                                <label for="password-confirm">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button class="btn btn-primary btn-block">Edit Password</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    @endsection


