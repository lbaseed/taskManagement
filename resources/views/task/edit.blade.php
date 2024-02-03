
@extends('layouts.app')

@section('content')

<div id="main" class="container">
    <div class="card">
        <h5 class="card-header">Edit Task</h5>
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
            <form method="POST" action="{{ route('update_task') }}">
            @csrf
            @method('PUT')
               
                <input type="hidden" name="id" value="{{ $task->id }}" />
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name *</label>
                    <input type="text" value="{{ $task->name }}" name="name" class="form-control" id="name" placeholder="task name">
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority *</label>
                    <input type="number" value="{{ $task->priority }}" name="priority" class="form-control" id="exampleFormControlInput1" placeholder="3">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                    <a id="deleteItem" href="/{{$task->id}}/delete" class="btn btn-outline-danger">Delete</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script>

    // $('#deleteItem').confirm();
    $('#deleteItem').click(function link(evt) {
        url = evt.target.href;
        if(!confirm("Do you really want to delete this?")) {
            return false;
        }
        window.open(url, '_self')
    })
</script>

@endsection