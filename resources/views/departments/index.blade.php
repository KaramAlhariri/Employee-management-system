@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-1">Departments</h1>
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
            <th scope="col">City</th>
            <th scope="col">Manage</th>
            <th scope="col"><a class="btn btn-success" href="{{ route('department.create') }}">Create</a>
          </tr>
        </thead>
        <tbody>
          @foreach ($departments as $dep)
          @if($dep != null)
          <tr>
            <th scope="row">{{ $dep->id }}</th>
            <td>{{ $dep->name }}
            <td>{{ $dep->city->country->name }}
            <td> {{ $dep->city->name }}
            <td> <a class="btn btn-success" href="{{ route('department.edit' , $dep->id) }}">edit</a>
                 <a class="btn btn-danger" href="{{ route('department.delete' , $dep->id) }}">delete</a>
          </tr>
          @endif
          @endforeach
         
          
        </tbody>
      </table>
@endsection