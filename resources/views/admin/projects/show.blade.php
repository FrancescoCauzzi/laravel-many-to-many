@extends('layouts\admin')

@section('content')
<div class="container text-white d-flex flex-column gap-4">
    <h1 >{{ucfirst($project->name)}}</h1>
    <hr>
    <div class="__proj-type">
        <h6>Project Type: {{ $project->type->name ?? 'not specified'}}</h6>
    </div>
    <div class="__proj-description">
        <h4>Description</h4>
        <p>
            {{$project->description}}
        </p>
    </div>

    <div class="__proj-timeline">
        <h4>The timeline of the project:</h4>
        <p class="fw-bold">
            <span >Start: </span>
            <span>{{date("F j, Y", strtotime($project->start_date))}}</span><span>, until: </span><span>{{date("F j, Y", strtotime($project->end_date))}}</span>
        </p>
    </div>
    <div class="__proj__status">
        <h4>Status of the project:</h4>
        <span class="fw-bold">{{ucwords($project->status)}}</span>
    </div>


    <div class="__btns-ctn d-flex gap-5">

        <div class="__edit-btn">
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.projects.edit', ['project' => $project->slug])}}">Edit this project</a></button>
        </div>
        <form class="text-center mb-5" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
            @csrf
            @method('DELETE')

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger text-uppercase fw-bold px-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this project?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- <div class="modal-body">
                    With this action you will delete this comic
                    </div> --}}
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- here specify type="submit" !!! otherwise nothing works --}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                </div>
            </div>


        </form>

    </div>

</div>

@endsection
