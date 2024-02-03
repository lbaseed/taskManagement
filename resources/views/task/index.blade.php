
@extends('layouts.app')

@section('content')
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<div id="main" class="container">
    <div class="card">
    <h5 class="card-header">All Tasks</h5>
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
        <ul class="list-group list-group-flush" id="task_sortable">
            @if (count($tasks)>0)
                @foreach ($tasks as $task)
                <a href="/{{ $task->id }}/edit" class="link-underline-light">
                        <li class="list-group-item" data-id="{{ $task->id }}">
                            <span class="serial">{{ $loop->index + 1 }})</span>
                            <span>{{ $task->name }} </span>
                            <span class="pos_num"> [{{ $task->priority }}] </span>
                        </li>
                </a>
                @endforeach
                
            @else
            <li class="list-group-item">No task found</li>
            @endif
        </ul>
    </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $("#task_sortable").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {

                    var task_order_ids = new Array();
                    $('#task_sortable li').each(function() {
                        task_order_ids.push($(this).data("id"));
                    });
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ route('task.orderChange') }}",
                        dataType: "json",
                        data: {
                            task: task_order_ids,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                           
                            $('#task_sortable li').each(function(index) {
                                const priority = index + 1;
                                $(this).find('.pos_num').text('[' + priority + ']');
                                $(this).find('.serial').text( priority + ')');
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection