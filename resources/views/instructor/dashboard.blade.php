@extends('user.dashboard')
@section('instructor-page')
<div class="container mt-5">
    <div class="row">
        <!-- Welcome Message -->
        <div class="col-12">
            
            <p class="lead">Voici un aperçu de vos activités et outils de gestion des cours.</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total des Cours</div>
                <div class="card-body">
                    <center><h2 class="card-title">{{ $courseCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Étudiants Inscrits</div>
                <div class="card-body">
                    <center><h2 class="card-title">{{ $studentCount }}</h2></center>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Évaluations à Corriger</div>
                <div class="card-body">
                    <center><h2 class="card-title">{{--{{ $pendingEvaluations }}--}} 0</h2></center>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Messages Non Lus</div>
                <div class="card-body">
                    <center><h2 class="card-title">{{--{{ $unreadMessages }}--}}0</h2></center>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="row mt-4">
        <div class="col-md-4" style="min-width: 100%">
            <div class="card mb-3">
                <div class="card-header">Mes Cours</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($courses as $course)
                        <li class="list-group-item">
                            <a href="{{--{{ route('instructor.course.show', $course->id) }}--}}">{{ $course->title }}</a>
                            <span class="badge bg-primary">{{$course->students_count }} &eacute;tudiant(e)(s)</span>
                        </li>
                        @empty
                            <h4>Vous n'avez pas encore de cours, vous pouvez en cr&eacute;er d&egrave;s maintenant...</h4>
                        @endforelse
                    </ul>
                    <div class="d-flex justify-content-center mt-3" >
                        {{$courses->onEachSide(1)->links()}}
                    </div>
                    <a href="{{ route('instructor.course.create') }}" class="btn btn-primary mt-3">Créer/Modifier un Cours</a>
                </div>
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Messages</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        {{--@foreach($messages as $message)--}}
                        <li class="list-group-item">
                            <a href="{{--{{ route('instructor.message.show', $message->id) }}--}}">{{--{{ $message->subject }}--}}Subject</a>
                            <span class="badge bg-warning">Created at ...{{--{{ $message->created_at->diffForHumans() }}--}}</span>
                        </li>
                       {{-- @endforeach--}}
                    </ul>
                    <a href="{{--{{ route('instructor.message.index') }}--}}" class="btn btn-primary mt-3">Voir Tous les Messages</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Outils</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{--{{ route('instructor.gradebook') }}--}}">Carnet de Notes</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{--{{ route('instructor.resources') }}--}}">Ressources Pédagogiques</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{--{{ route('instructor.settings') }}--}}">Paramètres du Compte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection