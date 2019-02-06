@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">

        <div class="flex justify-between items-end w-full">
            <h2 class="text-grey text-sm font-normal">New Project</h2>
            <a href="/projects/create" class="no-underline bg-blue text-white rounded-lg text-sm py-2 px-5"
               style="box-shadow: 0 2px 7px 0 #b0eaff; ">New Project</a>
        </div>

    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        <div class="lg:w-1/3 px-3 pb-6">
            @forelse($projects as $project)
                @include('projects.card')
            @empty
                <div>No projects here</div>
            @endforelse
        </div>
    </main>
@endsection
