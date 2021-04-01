@extends('layouts.app')

@section('title', 'Administration d\'année')

@section('page_name', 'Administration d\'année | Gestion des groupes')

@section('content')
    <div class="box">
        Cette page permet de gérer les groupes. Attention, casser des groupes peut entrainer une corruption de la base
        de donnée.
        Veuillez vous réferrer au manuel
    </div>
    <div class="groups box">
        <div class="columns">
            <div class="column">
                #
            </div>
            <div class="column">
                Nom
            </div>
            <div class="column">
                Utilisateurs
            </div>
            <div class="column">
                Actions
            </div>
        </div>
        @foreach($groups->filter(function ($value, $key) {
    return $value->parent_group == null;
}) as $group)
            <div class="group parent-group">
                <div class="columns">
                    <div class="column is-2">
                        {{$group->id}}
                    </div>
                    <div class="column">
                        {{$group->name}}
                    </div>
                    <div class="column">
                        {{$group->users_count}}
                    </div>
                    <div class="column">
                        <a href="{{route('administration.groups.group.edit', ['group' => $group->id])}}"><i
                                class="fas fa-edit"></i> Editer</a>
                    </div>
                </div>
            </div>
            @foreach($group->childs as $childGroup)
                <div class="group child-group">
                    <div class="columns">
                        <div class="column is-2">
                            > {{$childGroup->id}}
                        </div>
                        <div class="column">
                            {{$childGroup->name}}
                        </div>
                        <div class="column">
                            {{$childGroup->users()->count()}}
                        </div>
                        <div class="column">
                            <a href="{{route('administration.groups.group.edit', ['group' => $group->id])}}"><i
                                    class="fas fa-edit"></i> Editer</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Création de groupe
            </p>
        </header>
        <div class="columns">
            <div class="column">
                <div class="card-content">
                    <div class="content">
                        <form method="POST"
                              action="{{route('administration.groups.create')}}">
                            @csrf
                            <div class="field">
                                <label class="label">Nom</label>
                                <div class="control">
                                    <input class="input" type="text" name="name">
                                </div>
                                @error('name') <p class="help is-danger">{{ $message }} </p>@enderror
                            </div>
                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <input class="input" type="text" name="description">
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
                                            <option value="0" @if($group->rank == 0) selected @endif>Etudiant
                                            </option>
                                            <option value="1" @if($group->rank == 1) selected @endif>Délégué
                                            </option>
                                            <option value="2" @if($group->rank == 2) selected @endif>Comité</option>
                                            <option value="4" @if($group->rank == 4) selected @endif>Staff</option>
                                            <option value="5" @if($group->rank == 5) selected @endif>
                                                Administrateur
                                            </option>
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
@endsection
