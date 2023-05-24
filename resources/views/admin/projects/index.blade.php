
@extends('layouts.admin')

@section('content')

<div class="container py-2">
    <h1 class="text-white">Here are all the projects</h1>
    <table class="text-white table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Type</th>
            <th>Technologies</th>
            <th>Show</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->name}}</td>
                <td>{{$project->description}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->type?->name}}</td>
                <td>
                    @foreach ($project->technologies as $tech)
                    <span class="mx-1">{{$tech->name}}</span>
                    @endforeach
                </td>
                <td class="text-center"><a href="{{route('admin.projects.show', ['project' => $project])}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                <td class="text-center"><a href="{{route('admin.projects.edit', ['project' => $project])}}"><i class="fa-solid fa-file-pen"></a></td>

            </tr>

            @endforeach
        </tbody>
    </table>
    <hr>
    <div class="__btns-ctn py-3">
        <button class="btn btn-primary"><a class='fw-bold' href="{{route('admin.projects.create')}}">Add a new project</a></button>
    </div>
</div>

@endsection
