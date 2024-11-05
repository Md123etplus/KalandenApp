<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kalanden</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E6F4EA;">
    <a class="navbar-brand" style="font-weight:bold;margin-right:10rem;" href="{{route('dashboard')}}"><span style="color:green">Kalan</span><span style="color:rgb(255, 255, 0)">Dén</span>&nbsp;<span style="color:red">App</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active" style="margin-left: 50%;">
            <a class="nav-link" href="{{route('dashboard')}}">Home </a>
        </li>
        <li class="nav-item" style="margin-left: 40%;">
            <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item" style="margin-left: 40%;">
            <a class="nav-link" href="#">Pricing</a>
        </li>
    </ul>
    
    @auth
    {{-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="padding:0" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mon Profil (<strong>{{ Auth::user()->role }}</strong>)
          </a>
          <em>{{ Auth::user()->email }}</em>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="overflow-y: auto; max-height: 300px;">
            <a class="dropdown-item" href="{{route('editProfile')}}">Modifier le profil</a>
            <a class="dropdown-item" href="{{route('changePassword')}}">Changer le mot de passe</a>
            <a class="dropdown-item" href="#">Paramètres de confidentialité</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Mon tableau de bord</a>
            <a class="dropdown-item" href="{{route('mesCours',Auth::user()->id)}}">Mes cours</a>
            <a class="dropdown-item" href="#">Ma progression</a>
            <a class="dropdown-item" href="#">Mes réalisations</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Centre d'aide</a>
            <a class="dropdown-item" href="#">Contacter le support</a>
            <a class="dropdown-item" href="#">FAQ</a>
            <a class="dropdown-item" href="#">Signaler un problème</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Envoyer un feedback</a>
            <a class="dropdown-item" href="#">Proposer une fonctionnalité</a>
            <a class="dropdown-item" href="#">Évaluer notre service</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('logout')}}">Déconnexion</a>
            <a class="dropdown-item" href="#">Changer de compte</a>
        </div>
        
        
      </li>
  </ul>
  @endauth
    </div>
</nav>
    @auth
    <div class="btn-group dropup" style="position: fixed; bottom: 2%; right: 2%;z-index:100">
        <button type="button" onclick="document.getElementById('interface').style.display='flex'" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Assistant
        </button>
        <div id="interface" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 80%; width: 40%; position: fixed; bottom: 10%; left: 55%; display: none; background-color: #fff; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 10px;">
            {{-- <h5 style="margin-bottom: 10px;">Bonjour, je suis votre assistant personnel. Que puis-je faire pour vous?</h5> --}}
            <center><b><h4 style="margin-bottom: 10px;">Assistant personnel</h4></b></center>
            <div id="message-container" style="max-height: 300px; overflow-y: auto; padding: 10px; border-bottom: 1px solid #eee;">
                <!-- Messages affichés ici -->
            </div>
            <div style="margin-top: 70%">
                <textarea id="message-input" class="form-control" placeholder="Tapez votre message ici..." rows="2"></textarea>
            </div>
            <div style="margin-top: 5px; display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-primary" onclick="sendMessage()">Envoyer</button>
                <button type="button" class="btn btn-secondary ms-2" onclick="document.getElementById('interface').style.display='none'">Fermer</button>
            </div>
        </div>
    </div>
    @endauth
    @yield('page-content')
    
    <footer style="background-color: black; color: white; padding: 3rem;">
      <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <h5>À propos</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum, velit eu fermentum consectetur, leo risus venenatis massa, vel pulvinar elit lacus nec tortor.</p>
              </div>
              <div class="col-md-6">
                  <h5>Contact</h5>
                  <ul class="list-unstyled">
                      <li>Adresse: 123 Rue du Lorem Ipsum, Ville, Pays</li>
                      <li>Téléphone: +1234567890</li>
                      <li>Email: contact@example.com</li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>
  <script>
    document.addEventListener('click',function (){
        var interfaceElement = document.getElementById('interface');
        var buttonElement = event.target.closest('.btn-group.dropup');
        if (!interfaceElement.contains(event.target) && !buttonElement) {
            interfaceElement.style.display = 'none';
        } // document.getElementById('interface').style.display='none'
    });
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Cours 1', 'Cours 2', 'Cours 3', 'Cours 4', 'Cours 5'],
            datasets: [{
                label: 'Nombre d\'étudiants inscrits',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    @yield('scripts')
</script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>