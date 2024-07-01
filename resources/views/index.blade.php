@extends('./layouts/layout')
@section('page-content')
<!--
<div class="card">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
<div class="card" aria-hidden="true">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
  </div>
</div>-->

<section class="hero section" style="padding-bottom:20%">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                <h1 style="color: #5D9CEC;">Des Solutions Innovantes pour Votre Éducation</h1>
                <p style="color: #58B368;">Nous sommes une équipe de concepteurs talentueux.</p>
                <div class="d-flex" >
                    <a href="{{route('login')}}" class="btn-get-started" style="text-decoration:none;background-color: #D2B48C; color: #FFFFFF;margin-right:3rem;">Se connecter</a>
                    <a href="{{route('register')}}"  class="btn-get-started" style="text-decoration:none;color: #FFFFFF;"><span>Commencer</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{asset('elearn.jpg')}}" class="img-fluid animated" alt="Image de e-learning" draggable="false">
            </div>
        </div>
    </div>


</section>

@endsection
