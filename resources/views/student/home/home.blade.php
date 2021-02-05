@extends('layouts.app')

@section('title', 'Accueil')

@section('page_name', 'Accueil')

@section('content')

    <main class="content">
        @if (!Auth::user()->hasClassGroup())
            <div class="notification is-warning">
                Bonjour {{ Auth::user()->fullName }}, <br />
                Vous n'avez pas encore choisi votre classe, veuillez la sélectionner dans votre profil
            </div>
        @endif
        <div class="index-container">
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
                                    <span>Tâches en cours : 3</span>
                                </li>
                                <li class="grid-item summary-works"><i class="fas fa-truck-loading"></i><span>En attente de
                                        livrable : 1</span>
                                </li>
                            </ul>
                        </section>
                        <section>
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
                        </section>
                    </div>
                </div>
            </section>



            <section class="worked-recently">
                <h1 class="section-title">Travaillés récemment</h1>

                <hr class="section-line" />

                <div class="container">
                    <article class="project-item">
                        <div class="project-thumbnail">
                            <span class="thumbnail-title">Valise Bombe</span>
                            <span class="thumbnail-user">
                                <i class="fas fa-crown"></i>
                                John Doe</span>
                        </div>
                    </article>
                </div>
            </section>

            <section class="worked-recently">
                <h1 class="section-title">Nouvelles tâches</h1>

                <hr class="section-line" />

                <div class="container">
                    <article class="task-item">
                        <div class="task-content">
                            <h1 class="task-title">Coder la page des tâches</h1>
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
                </div>
            </section>
        </div>
    </main>

@endsection
