@extends('layouts.app')

@section('title', 'Accueil')

@section('page_name', 'Accueil')

@section('content')

    <main class="content">
        @if (!Auth::user()->hasClassGroup())
            <div class="notification is-warning">
                Bonjour {{ Auth::user()->fullName }}, <br/>
                Vous n'avez pas encore choisi votre classe, veuillez la sélectionner dans votre profil
            </div>
        @endif
        <div class="content-container">
            <section class="summary">
                <div class="summary-container container">

                    <h3 class="summary-name">{{ Auth::user()->fullName }} :</h3>
                    <div class="row">
                        <section>
                            <h5>Résumé de la semaine :</h5>
                            <ul>
                                <li class="grid-item summary-stars "><i class="fas fa-star star"></i>
                                    <span>Etoiles : 4</span>
                                </li>
                                <li class="grid-item summary-tasks"><i class="fas fa-check-double"></i>
                                    <span>Tâches en cours : {{$tasksCount}}</span>
                                </li>
                                <li class="grid-item summary-works"><i class="fas fa-truck-loading"></i><span>En attente de
                                        livrable : {{$waitingForDeliverable}}</span>
                                </li>
                            </ul>
                        </section>
                        <!-- <section>
                            <h5>Evaluation :</h5>
                            <ul>
                                <li class="grid-item summary-total-stars">
                                    <i class="fas fa-star star"></i>
                                    <span>Cumul étoiles : 14</span>
                                </li>
                                <li class="grid-item summary-total-note">
                                    <i class="fas fa-marker"></i>
                                    <span>Note provisoire : 13.45 / 20</span>
                                </li>
                            </ul>
                        </section> -->
                    </div>
                </div>
            </section>


            <section class="worked-recently">
                <h1 class="section-title">Projets rejoints</h1>

                <hr class="section-line"/>

                <div class="container">
                    @foreach($projects as $project)
                        <article class="project-item">
                            <div class="project-thumbnail">
                                <span class="thumbnail-title">{{$project->name}}</span>
                                <span class="thumbnail-user">
                                <i class="fas fa-crown"></i>
                                {{$project->admins()->first()->fullName}}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="worked-recently">
                <h1 class="section-title">Vos tâches en cours</h1>

                <hr class="section-line"/>

                <div class="container">
                    @foreach($activeTasks as $activeTask)
                        <article class="task-item">
                            <div class="task-content">
                                <h1 class="task-title">{{$activeTask->name}}</h1>
                                <p class="task-description">Lorem, ipsum dolor sit.</p>
                                <div class="task-info">
                                    <span>4h</span>
                                    <ul>
                                        <li><i class="fas fa-star star"></i></li>
                                        <li><i class="fas fa-star star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="task-project">
                                <h1 class="task-project-title">Adidash</h1>
                                <span class="project-leader"></span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

@endsection
