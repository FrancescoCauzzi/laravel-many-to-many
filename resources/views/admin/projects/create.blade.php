@extends('layouts/admin')

@section('content')
<div class="container __create-ctn text-white">
  <h1>Add a project</h1>

  <form action="{{route('admin.projects.store')}}" method="POST" class="py-5">
    @csrf

    <div class="mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name')}}">
      @error('name')

        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="type_id">Type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
            <option>None</option>
            @foreach ($types as $type )
            <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
            @endforeach
        </select>
        @error('type_id')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <h6>Technologies</h6>
        <div class="row">
            @foreach ($technologies as $tech)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-check">
                    <input type="checkbox" id="technology-{{$tech->id}}" name="technologies[]" value="{{$tech->id}}" @checked(in_array($tech->id, old('technologies') ?? []))>
                    {{-- {{ old('technologies') && in_array($tech->id, old('technologies')) ? 'checked' : '' }} --}}
                    <label for="technology-{{$tech->id}}">{{$tech->name}}</label>
                </div>
            </div>
            @endforeach
        </div>
        @error('technologies')
        <div class="text-danger">
          {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="start_date">Start date</label>
      <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" id="start_date" value="{{old('start_date')}}">
      @error('start_date')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="end_date">End date</label>
        <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
        @error('end_date')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="status">Status</label>
      <select class="form-select @error('status') is-invalid @enderror" name="status" id="">

        @foreach ($statuses as $index => $status)
            <option value="{{ $status }}" {{ $status == old('status') ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach

    </select>
      @error('status')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>



    <button type="submit" class="btn btn-primary fw-bold">Add Project</button>

  </form>


</div>

@endsection
