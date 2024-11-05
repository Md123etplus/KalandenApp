@extends('user.dashboard')
@section('student-page')

<fieldset class="mt-4">
    <legend style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Cours disponibles</legend>
    <div id="courseCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            @php
                // foreach($courses as $course){
                //     echo $course->instructor->name;
                // }
                // {{dd($courses);}}
                //$coursesArray = $courses->toArray();
                $chunks = $courses->chunk(3);
            @endphp
            @forelse($chunks as $chunkIndex => $chunk)
            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                <div class="row">
                    @forelse($chunk as $course)
                    @php
                        $isEnrolled = Auth::user()->enrollments->contains('course_id', $course->id);
                    @endphp
                            <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card">
                                <img src="{{ asset('elearn.jpg') }}" class="card-img-top" alt="{{ $course->title }}" draggable="false">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course['title'] }}</h5>
                                    <label for="description"><strong>Description</strong></label>
                                    <p id="description" class="card-text">{{ Str::limit($course['description'], 100) }}</p>
                                    <br>
                                    <h6 id="prof" class="card-title mb-2 text-body-primary"><strong>Enseignant: </strong>{{ $course->instructor->name }}</h6>
                                    <p  class="card-title mb-2 text-body-primary">Prix: <strong>{{$course->price}} FCFA</strong></p>
                                    <br>
                                    {{-- <div class="card" id="">
                                        <div class="card-body" style="z-index:2001;position:absolute">
                                            Informations
                                        </div>
                                    </div> --}}
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailsModal{{$course->id}}">
                                            Voir details
                                        </button>
                                        <!-- Button incription modal -->
                                        
                                        @if(!$isEnrolled)

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$course->id}}" class="btn btn-primary d-inline ms-2">
                                        {{-- <button type="submit" class="btn btn-primary d-inline ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$course->id}}"> --}}
                                            S'inscrire
                                        </button>
                                        <!-- Modalincript -->
                                    <div class="modal fade" id="exampleModal{{$course->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription au cours <strong>{{ $course->title }}</strong></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire d'inscription -->
                                                    <form id="registration-form" action="{{route('inscription',$course->id)}}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nom </label>
                                                            <input type="text" class="form-control" id="name" placeholder="Ex : {{Auth::user()->name}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" placeholder="Ex : {{Auth::user()->email}}" inputmode="email">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Téléphone</label>
                                                            <input type="tel" class="form-control" id="phone" placeholder="Ex : +22377597587" inputmode="tel">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="payment-method" class="form-label">Méthode de paiement</label>
                                                            <select class="form-select" id="payment-method" >
                                                                <option value="" selected>Choisir...</option>
                                                                <option value="orange_money">Orange Money</option>
                                                                <option value="mobicash">MobiCash</option>
                                                                <option value="telecel">Telecel</option>
                                                                {{-- <option value="stripe">Stripe</option> --}}
                                                                {{-- <option value="bmce">BMCE</option> --}}
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary" form="registration-form">Effectuer le paiement</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                       
                                        @else
                                            <form action="{{route('lectureCours',$course->id)}}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal">
                                                    Lire Cours
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                    {{-- details --}}
                                    <div class="modal fade" id="detailsModal{{$course->id}}" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 style="" class="modal-title fs-5" id="detailsModalLabel">Inscription au cours <strong>{{ $course->title }}</strong></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Description:</strong> {{ $course->description }}</p>
                                                <p><strong>Enseignant:</strong> {{ $course->instructor->name }}</p>
                                                <p><strong>Prix:</strong> {{ $course->price }} FCFA</p>
                                                <!-- Ajoutez d'autres détails du cours ici -->
                                            </div>
                                    
                                                <div class="modal-footer d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                                {{-- <button type="button" class="btn btn-primary">Effectuer le paiement</button> --}}
                                                </div>
                                           
                                        </div>
                                        </div>
                                    </div>
                                    {{-- <a href="{{route('showPayement')}}" class="btn btn-primary"></a> --}}
                                    <!--<div class="overlay">
                                        
                                        <h6><strong>{{$course['title']}}</strong></h6>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        @empty
                        <h2>Pas de cours disponible!</h2>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="carousel-item active">
                <div class="row">
                    <div class="col text-center">
                        <p style="font-size: large">Aucun cours disponible pour le moment.</p>
                    </div>
                </div>
            </div>
        @endforelse
        
        <a class="carousel-control-prev" style="margin-top:21%; background-color:rgb(130, 130, 130); width: 40px; height: 40px; border-radius: 50%" href="#courseCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#courseCarousel" style="margin-top:21%;background-color: rgb(130, 130, 130); width: 40px; height: 40px; border-radius: 50%;" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        
        
        </div>
        
    </div>
</fieldset>

<fieldset class="mt-4">
    <legend style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Statistiques</legend>
    <div class="card">
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</fieldset>
</div>

@endsection