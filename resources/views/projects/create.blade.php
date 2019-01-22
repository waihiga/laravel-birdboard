@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">

        @csrf

        <h1 class="heading is-1">Create a project</h1>

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="controls">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="controls">
                <textarea name="description"  for="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">

            <div class="controls">
                <button type="submit" class="button is-link" >Submit</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
@endsection
