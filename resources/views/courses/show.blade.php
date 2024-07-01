@extends('layouts/layout')

@section('page-content')
    @forelse($courses as $course)
        
    @empty
    <h2>Pas de cours</h2>
    @endforelse
@endsection