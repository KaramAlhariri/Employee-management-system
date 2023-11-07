@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-1">Countries</h1>
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
            <th scope="col">Manage</th>
            <th scope="col"><a class="btn btn-success" href="{{ route('country.create') }}">Create</a>
          </tr>
        </thead>
        <tbody>
          @foreach ($countries as $country)
          <tr>
            <th scope="row">{{ $country->id }}</th>
            <td>{{ $country->name }}</td>
            <td> <a class="btn btn-success" href="{{ route('country.edit' , $country->id) }}">edit</a>
            <a class="btn btn-danger" href="{{ route('country.delete' , $country->id) }}">delete</a>
          </tr>
          @endforeach
         
          
        </tbody>
      </table>
@endsection