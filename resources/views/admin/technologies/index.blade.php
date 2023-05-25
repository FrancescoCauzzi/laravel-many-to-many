
@extends('layouts.admin')

@section('content')

<div class="container py-2">
    <h1 class="text-white">Here are all the technologys</h1>
    <table class="text-white table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Number of projects</th>
            <th>Show</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>{{$technology->name}}</td>
                <td>{{$technology->description}}</td>
                <td>{{$technology->slug}}</td>
                <td class="text-center">{{count($technology->projects)}}</td>
                 <td class="text-center"><a href="{{route('admin.technologies.show', ['technology' => $technology])}}"><i class="fa-solid fa-magnifying-glass"></i></a>
                </td>
                <td class="text-center"><a href="{{route('admin.technologies.edit', ['technology' => $technology])}}"><i class="fa-solid fa-file-pen"></a></td>

            </tr>

            @endforeach
        </tbody>
    </table>
    <hr>
    <div class="__btns-ctn py-3">
        <button class="btn btn-primary"><a class='fw-bold' href="{{route('admin.technologies.create')}}">Add a new technology</a></button>
    </div>
</div>

@endsection
