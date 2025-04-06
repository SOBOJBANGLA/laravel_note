@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" class="form-control" required>
        <label>Description:</label>
        <textarea name="description" class="form-control"></textarea>
        <label>Assign to:</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success mt-2">Assign Task</button>
    </form>
</div>
@endsection
