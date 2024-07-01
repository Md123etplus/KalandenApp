@extends('layouts/layout')

@section('page-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informations personnelles</div>

                <div class="card-body mb-5">
                    <form method="POST" action="{{ route('profileUpdate',Auth::user()->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="nom">Nom </label>
                            <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom" name="nom" value="{{ old('nom') ?? Auth::user()->name }}">
                            @error('nom')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                        
                        <div class="form-group">
                            <label for="prenom">Prenom </label>
                            <input type="text" id="prenom" class="form-control" placeholder="Entrez votre prenom" name="prenom" value="{{ old('prenom') ?? Auth::user()->name }}">
                            @error('prenom')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                        <div class="form-group">
                            <label for="mail">Email </label>
                            <input type="email" id="mail" class="form-control" placeholder="Entrez votre email" name="email" value="{{ old('email') ?? Auth::user()->email }}">
                            @error('email')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Mettre a jour
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
