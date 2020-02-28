<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>La maison de l'architecture</title>
  <meta name="description" content="La maison de l'architecture">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>


<body>
 
    <!-- Navbar du dessus -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">La maison de l'architecture</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="#accueil">Accueil</a>
                </li>
            <li class="nav-item">
              <a class="nav-link" href="#equipe">Qui sommes nous ?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
              </li>
          </ul>
        </div>
      </nav>

      <!-- Carousel -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="images/archi1.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                  <h5>Un design futuriste</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/accueil.jpg" alt="Second slide">
              <div class="carousel-caption d-none d-md-block">
                  <h5>Un design futuriste</h5>
              </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/archi2.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Un design futuriste</h5>
                </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block w-100" src="images/archi3.jpg" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>Un design futuriste</h5>
                  </div>
                </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

  <div class="container">

    <div id="accueil">
      <h1>Bienvenue dans notre espace</h1>
      <p>Nous sommes spécialisés dans tous types de constructions et nous prenons en charge les projets de A à Z. Vous pouvez
        nous confier en toute confiance des projets de toutes dimensions, des plus simples aux plus osés. Notre équipe est
        efficace, réactive et compétente. Nous entretenons toujours un dialogue de tous les instants avec nos clients. Bien
        qu'à la pointe de notre activité nous pratiquons des prix rigoureux et adaptés à tous les budgets.</p>
    </div>
    
    <div id="equipe">
      <h1>Une équipe efficace</h1>
      <p>Notre équipe est jeune, experte et motivée. Notre entreprise est certifiée ISO 9001. Nous cherchons en permanence à
        améliorer la qualité de nos services et nous sommes à l'écoute de nos clients.</p>
    </div>

    <div id="contact">
      <h1>Un message pour nous ?</h1>
      <form>
        <div>
          <input type="email" placeholder="Votre email">
        </div>
        <div>
          <textarea rows="3" placeholder="Votre message"></textarea>
        </div>
        <div>
          <button type="submit">Envoyer</button>
        </div>
      </form>
    </div>

  </div>

  <footer>
    <a class="btn btn-default" href="#">
      <i class="fa fa-twitter fa-2x"></i>
    </a>
    <a class="btn btn-default" href="#">
      <i class="fa fa-facebook fa-2x"></i>
    </a>
    <a class="btn btn-default" href="#">
      <i class="fa fa-google-plus fa-2x"></i>
    </a>
    <a class="btn btn-default" href="#">
      <i class="fa fa-flickr fa-2x"></i>
    </a>
    <a class="btn btn-default" href="#">
      <i class="fa fa-spotify fa-2x"></i>
    </a>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>

</html>