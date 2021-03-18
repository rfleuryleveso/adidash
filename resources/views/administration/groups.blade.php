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
                        <a href="{{route('administration.groups.group.edit', ['group' => $group->id])}}"><i class="fas fa-edit"></i> Editer</a>
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
                            <a href="{{route('administration.groups.group.edit', ['group' => $group->id])}}"><i class="fas fa-edit"></i> Editer</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
