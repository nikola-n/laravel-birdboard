@extends('layouts.app')
@section('content')
    <h1>Create a project</h1>
    <form method="post" action="/projects">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/projects">Cancel</a>
    </form>
@endsection
