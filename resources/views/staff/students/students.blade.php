@extends('layouts.app')

@section('title', $user->first_name)

@section('page_name', "{$user->first_name}")

@section('content')

    <div class="columns">
        <div class="column is-two-third">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Élèves
                    </p>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Classe</th>
                                <th>Détail</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($user as $user)
                                <tr>
                                    <th>{{ $user->first_name }}</th>
                                    <td>{{ $user->users->map(function ($member) {
                                                return $member->fullName;
                                            })->join(', ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="is-block">
                           {{ $user->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="card" style="overflow: visible">
                <header class="card-header">
                    <p class="card-header-title">
                        Filtres
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('staff.students') }}">
                        @csrf
                        <div class="field">
                            <label class="label">Nom</label>
                            <div class="control">
                                <input class="input" value="{{ request()->input('name') }}" name="name" type="text" placeholder="Nom partiels autorisés">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
