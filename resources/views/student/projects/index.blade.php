@extends('layouts.app')

@section('title', 'Projets')

@section('page_name', 'Projets')

@section('content')

    <div class="columns is-multiline">
        @foreach ($groups as $group)
            @foreach ($group->projects as $project)
                <div class="column is-one-quarter ">
                    <a href="{{ route('student.projects.project.details', ['project' => $project->id]) }}">
                        <div class="box @if ($project->background_image) project-has-background has-text-white @endif" @if ($project->background_image) style="background-image:
                                url('{{ $project->background_image }}')" @endif>
                            <p class="is-size-4">{{ $project->name }}</p>
                            <p class="is-size-7 @if ($project->background_image) has-text-white @else has-text-grey-dark @endif">
                                {{ !empty($project->intro) ? $project->intro : Str::limit($project->description, 32) }}
                            </p>
                            <p class="is-size-7 @if ($project->background_image) has-text-white @else has-text-grey-dark @endif mt-3"><i
                                    class="far fa-user"></i> {{ $project->admins->map(function ($user) {
                                    return $user->fullName;
                                })->join(', ') }}</p>
                            @if ($project->ends_at)
                                <p class="is-size-6 @if ($project->background_image) has-text-white @else has-text-grey-dark @endif"><i
                                        class="far fa-calendar"></i> {{ $project->ends_at->toDateString() }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>

@endsection
