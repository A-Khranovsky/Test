@extends('layout')

@section('title', 'Todo-list')

@section('content')
@isset($tasks)
@foreach($tasks as $task)
<div class="card w-80 m-3 border-dark">
    <div class="card-header">
        <h5 class="card-title">
            {{$task->id}}
        </h5>
    </div>
    <div class="card-body">
        <p class="card-text">{{$task->text}}</p>
    </div>
</div>
@endforeach
@endisset
@endsection
