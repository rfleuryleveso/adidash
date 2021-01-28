@extends('layouts.app')

@section('title', $task->name)

@section('page_name', "{$project->name} | {$task->name}")

@section('content')
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Résumé de la tâche
                    </p>
                </header>
                <div class="card-content">
                    <x-markdown :content="$task->description" />
                </div>
            </div>
            <div class="card mt-5">
                <header class="card-header">
                    <p class="card-header-title">
                        Equipe
                    </p>
                </header>
                <div class="card-content">
                    @foreach ($task->users as $user)
                        <div>
                            <h5 class="is-size-5"><i class="fas fa-user"></i> {{ $user->fullName }}
                                @if ($user->hasClassGroup())
                                    ({{ $user->getClassGroups()->first()->name }}) @endif
                            </h5>
                            {{ $task->deliverables()->whereIn(
                                        'id',
                                        $user->deliverables()->pluck('deliverables.id')->toArray(),
                                    )->count() }} livrable(s) sur cette tâche<br />
                            <i class="fas fa-users-cog"></i> Chef de projet: @if ($grades
            ->where('user_id', $user->id)
            ->where('evaluation_type', 'PROJETCHIEF')
            ->first())
                                {{ $grades->where('user_id', $user->id)->where('evaluation_type', 'PROJETCHIEF')->first()->grade }}
                                étoiles
                            @else
                                Pas encore noté
                            @endif
                            <br />

                            <i class="fas fa-user-shield"></i> Staff: @if ($grades
            ->where('user_id', $user->id)
            ->where('evaluation_type', 'STAFF')
            ->first())
                                {{ $grades->where('user_id', $user->id)->where('evaluation_type', 'STAFF')->first()->grade }}
                                étoiles
                            @else
                                Pas encore noté
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Livrables
                    </p>
                </header>
                <div class="card-content">
                    @foreach ($task->deliverables as $deliverable)
                        <div>
                            <h3 class="is-size-5">Livrable #{{ $deliverable->id }}</h3>
                            Lien vers le livrable: <a
                                href="{{ $deliverable->url }}">{{ parse_url($deliverable->url)['host'] }}</a><br /><br />
                            Membres concernés:
                            <ul>
                                @foreach ($deliverable
            ->users()
            ->withPivot('level')
            ->get()
        as $user)
                                    <li><i class="fas fa-user"></i> {{ $user->fullName }} - {{ $user->pivot->level }}</li>
                                @endforeach
                            </ul><br />
                            Commentaires: <br />
                            {{ $deliverable->comments }}
                        </div>
                        @if (!$loop->last)
                            <hr />
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card mt-5">
                <header class="card-header">
                    <p class="card-header-title">
                        Livrables
                    </p>
                </header>
                <div class="card-content">

                </div>
            </div>
        </div>
    </div>
@endsection
