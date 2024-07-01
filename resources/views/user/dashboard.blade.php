@extends('../layouts/layout')
@section('page-content')

<div class="container mt-5">
    <div class="card">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="card-header">
            <p style="font-size:xx-large">Bienvenue de nouveau, <strong>{{ Str::upper(Auth::user()->name) }}</strong> !</p>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <footer class="blockquote-footer">"Apprendre, c'est découvrir ce que l'on sait déjà. Faire, c'est démontrer que vous le savez. Enseigner, c'est rappeler aux autres qu'ils savent tout aussi bien que vous." - <cite title="Citation de David Viscott">David Viscott</cite></footer>
            </blockquote>
            
        </div>
    </div>

    @yield('student-page')
    @yield('instructor-page')
</div>
<script>
    // Initialize popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
</script>
@endsection
@section('scripts')

$('#detailsModal').on('show.bs.modal', function () {
    $('#carouselExample').carousel('pause');
});

$('#detailsModal').on('hidden.bs.modal', function () {
    $('#carouselExample').carousel('cycle');
});

@endsection