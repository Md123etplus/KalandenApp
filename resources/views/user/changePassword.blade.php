@extends('layouts/layout')
@section('page-content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informations personnelles</div>

                <div class="card-body mb-5">
                    <form method="POST" action="{{ route('password.change',Auth::user()->id) }}">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <label for="ancienmdp">Ancien Mot de passe </label>
                            <input type="text" class="form-control" id="ancienmdp" placeholder="Entrez votre ancien mot de passe" name="ancienmdp" value="{{ old('ancienmdp')}}">
                            @error('ancienmdp')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                        <div class="form-group">
                            <label for="nouveaumdp">Nouveau Mot de Passe </label>
                            <input type="text" id="nouveaumdp" class="form-control" placeholder="Entrez votre nouveau mot de passe" name="nouveaumdp" value="{{ old('nouveaumdp')}}">
                            @error('nouveaumdp')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                        <div class="form-group">
                            <label for="nouveaumdp_confirmation">Confirmer le nouveau Mot de Passe </label>
                            <input type="text" id="nouveaumdp_confirmation" class="form-control" placeholder="Entrez votre nouveau mot de passe encore une fois" name="nouveaumdp_confirmation" value="{{ old('nouveaumdp_confirmation')}}">
                            @error('nouveaumdp_confirmation')
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