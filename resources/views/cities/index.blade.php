@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-1">Cities</h1>
    <ol class="breadcrumb mb-1">
    </ol>
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif
@if (session('message2'))
<div class="alert alert-danger" role="alert">
    {{ session('message2') }}
</div>
@endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Country</th>
            <th scope="col">Manage</th>
            <th scope="col"><a class="btn btn-success" href="{{ route('city.create') }}">Create</a>
          </tr>
        </thead>
        <tbody>
          @foreach ($cities as $city)
          <tr>
            <th scope="row">{{ $city->id }}</th>
            <td>{{ $city->name }}</td> 
            <td>{{ $city->country->name }}
            <td> <a class="btn btn-success" href="{{ route('city.edit' , $city->id) }}">edit</a>
               <a class="btn btn-danger" href="{{ route('city.delete' , $city->id) }}">delete</a>
          </tr>
          @endforeach
         
          
        </tbody>
      </table>
@endsection