@extends('layouts/layout')
@section('page-content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    {{-- <div class="card-body">
                        <h6 class="card-subtitle mb-2" style="color:blue"><strong><ul>Introduction</ul></strong></h6>
                        <p class="card-text">{{$course->description}}</p>
                    </div> --}}

                    <div class="card mb-3 mt-3">
                        <div class="card-header" id="heading{{ $course->id }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link card-title" data-bs-toggle="collapse" data-bs-target="#collapse{{ $course->id }}" aria-expanded="true" aria-controls="collapse{{ $course->id }}">
                                    <strong>Introduction</strong>
                                </button>
                            </h5>
                        </div>
            
                        <div id="collapse{{ $course->id }}" class="collapse" aria-labelledby="heading{{ $course->id }}" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p class="card-text">{{ $course->description }}</p>
                            </div>
                        </div>
                    </div>

                    @php
                    $i=0;
                    @endphp
                    @forelse($course->modules as $module)
                    <div class="card mb-3">
                        <div class="card-header" id="heading{{ $module->id }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link card-title" data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}" aria-expanded="true" aria-controls="collapse{{ $module->id }}">
                                    <strong>{{++$i .". "."$module->title" }}</strong>
                                </button>
                            </h5>
                        </div>
            
                        <div id="collapse{{ $module->id }}" class="collapse" aria-labelledby="heading{{ $module->id }}" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p class="card-text">{{ $module->description }}</p>
                            </div>
                        </div>
                    </div>

                    @empty
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                           Accun module pour ce cours
                        </a>
                    </li>
                    @endforelse
                    
                    
                    <div class="card mb-3">
                        <div class="card-header" id="headingConclusion">
                            <h5 class="mb-0">
                                <button class="btn btn-link card-title" data-bs-toggle="collapse" data-bs-target="#collapseConclusion" aria-expanded="true" aria-controls="collapseConclusion">
                                    <strong>Resum&eacute;</strong>
                                </button>
                            </h5>
                        </div>
            
                        <div id="collapseConclusion" class="collapse" aria-labelledby="headingConclusion" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p class="card-text">...</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header" id="headingExamenFinal">
                            <h5 class="mb-0">
                                <button class="btn btn-link card-title" data-bs-toggle="collapse" data-bs-target="#collapseExamenFinal" aria-expanded="true" aria-controls="collapseExamenFinal">
                                    <strong>Examen final</strong>
                                </button>
                            </h5>
                        </div>
            
                        <div id="collapseExamenFinal" class="collapse" aria-labelledby="headingExamenFinal" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p class="card-text">...</p>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <section class="page-content">
                <!-- Course Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{$course->title}}</h1>
                </div>

                <!-- Lecture Content -->
                <div class="lecture-content">
                    <h2>Leçon Actuelle</h2>
                    <p>
                        Contenu de la leçon. Ceci peut inclure du texte, des images, des vidéos, etc.
                    </p>
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/your-video-id" allowfullscreen></iframe>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>

                <!-- Downloadable Resources -->
                <div class="resources mt-5">
                    <h3>Ressources Téléchargeables</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Document PDF 1</a></li>
                        <li class="list-group-item"><a href="#">Document PDF 2</a></li>
                        <li class="list-group-item"><a href="#">Document PDF 3</a></li>
                    </ul>
                </div>

                <!-- Discussion Section -->
                <div class="discussion mt-5">
                    <h3>Discussion</h3>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Discussion sur cette leçon</h5>
                            <form>
                                <div class="form-group">
                                    <textarea class="form-control" id="discussion-input" rows="3" placeholder="Écrivez votre commentaire..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Utilisateur 1</h6>
                            <p class="card-text">Ceci est un commentaire d'utilisateur.</p>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Utilisateur 2</h6>
                            <p class="card-text">Ceci est un autre commentaire d'utilisateur.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
@endsection