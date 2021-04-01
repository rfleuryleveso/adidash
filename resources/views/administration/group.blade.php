@extends('layouts.app')

@section('title', 'Administration d\'année')

@section('page_name', 'Administration d\'année | Groupe')

@section('content')
    <div class="box">
        Cette page permet de gérer un groupe. Veuillez vous réferrer au manuel
    </div>
    <div class="columns">
        <div class="column is-half">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Gestion de groupe : {{ $group->name }}
                    </p>
                </header>
                <div class="columns">
                    <div class="column">
                        <div class="card-content">
                            <div class="content">
                                <form method="POST" action="{{route('administration.groups.group.update', ['group' => $group->id])}}">
                                    @csrf
                                    <div class="field">
                                        <label class="label">Nom</label>
                                        <div class="control">
                                            <input class="input" type="text" name="name" value="{{$group->name}}">
                                        </div>
                                        @error('name') <p class="help is-danger">{{ $message }} </p>@enderror
                                    </div>
                                    <div class="field">
                                        <label class="label">Description</label>
                                        <div class="control">
                                            <input class="input" type="text" name="description" value="{{$group->description}}">
                                        </div>
                                        @error('description') <p class="help is-danger">{{ $message }} </p>@enderror
                                    </div>
                                    <div class="field">
                                        <label class="label">Groupe parent</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="parent_group">
                                                    <option value="">Aucun groupe parent</option>
                                                    @foreach($groups as $sGroup)
                                                        <option value="{{$sGroup->id}}"
                                                                @if($group->parent_group && ($group->parent->is($sGroup))) selected @endif >{{$sGroup->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('parent_group') <p class="help is-danger">{{ $message }} </p>@enderror
                                    </div>
                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input @if($group->is_class) checked @endif name="is_class" type="checkbox">
                                                Est-ce un groupe de classe ?
                                            </label>
                                        </div>
                                        @error('is_class') <p class="help is-danger">{{ $message }} </p>@enderror
                                    </div>
                                    <div class="field">
                                        <label class="label">Type de groupe</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="rank">
                                                    <option value="0" @if($group->rank == 0) selected @endif>Etudiant</option>
                                                    <option value="1" @if($group->rank == 1) selected @endif>Délégué</option>
                                                    <option value="2" @if($group->rank == 2) selected @endif>Comité</option>
                                                    <option value="4" @if($group->rank == 4) selected @endif>Staff</option>
                                                    <option value="5" @if($group->rank == 5) selected @endif>Administrateur</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('rank') <p class="help is-danger">{{ $message }} </p>@enderror
                                    </div>
                                    <div class="field">
                                        <label class="label">Auto expiration</label>
                                        <div class="control">
                                            <input class="input" type="text" name="auto_expire"
                                                   value="{{$group->auto_expire}}">
                                        </div>
                                        @error('auto_expire') <p class="help is-danger">{{ $message }} </p>@enderror
                                        <p class="help">Exemple: 1 day, 1 month, 2 months. Valeurs spéciales: N pour
                                            jamais, S pour semestre (PAS UTILISE ACTUELLEMENT !)</p>
                                    </div>
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button class="button is-link">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="button is-danger is-fullwidth mt-1" href="{{route('administration.groups.group.delete', ['group' => $group->id])}}">Supprimer le groupe</a>
        </div>
        <div class="column is-half">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Utilisateurs du groupe
                    </p>
                </header>
                <div class="columns">
                    <div class="column">
                        <div class="card-content">
                            <div class="content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th>{{$user->id}}</th>
                                            <td>
                                                {{$user->fullName}}
                                            </td>
                                            <td>
                                                <form method="POST"
                                                      action="{{route('administration.groups.group.toggleUser', ['group' => $group->id])}}">
                                                    @csrf
                                                    <input type="hidden" name="user" value="{{$user->id}}">
                                                    <button class="button is-warning" type="submit">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr/>
                                <p class="is-size-6">Ajouter un utilisateur</p>
                                <form method="POST"
                                      action="{{route('administration.groups.group.toggleUser', ['group' => $group->id])}}">
                                    @csrf
                                    <div class="field is-grouped">
                                        <div class="control is-expanded">
                                            <div class="select" style="width: 100%">
                                                <select name="user" style="width: 100%">
                                                    @foreach($allUsers as $user)
                                                        <option
                                                            value="{{$user->id}}">{{$user->fullName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <p class="control">
                                            <button class="button" type="submit">Ajouter l'utilisateur</button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
