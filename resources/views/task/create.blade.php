
@extends('layouts.app')

@section('content')

<div id="main" class="container">
    <div class="card">
        <h5 class="card-header">Create Task</h5>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong>SUCCESS!</strong>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                <strong>SUCCESS!</strong>
                {{ implode('', $errors->all(':message ')) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('store_task') }}">
            @csrf
                <div class="mb-3">
                <label for="project" class="form-label">Project Name</label>

                <select id="project" class="form-select" name="project" aria-label="Default select example">
                    <option selected>Select a Project *</option>
                    @if (count($projects)>0)
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">
                            {{ $project->name }}
                        </option>
                               
                        @endforeach
                    @else
                    <option>No project found</option>
                    @endif
                </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="task name">
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority *</label>
                    <input type="number" name="priority" class="form-control" id="exampleFormControlInput1" placeholder="3">
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>

        </div>
    </div>
</div>

@endsection