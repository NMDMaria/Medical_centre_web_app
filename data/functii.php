<?php
function generate_head()
{
  echo '<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="data/bootstrap/css/bootstrap.min.css" rel="stylesheet">


   <title>FMI PHP 2021 NMD233</title>';
}
function generate_page_upper()
{
    echo '  
    <script src="data/bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="data/bootstrap/js/popper.min.js"></script>
    <script src="data/bootstrap/js/bootstrap.min.js"></script>
    <div style="background:url(images/header_bckg.jpg)" class="jumbotron bg-cover">
        <div class="container py-5 text-center">
                <p style = "font-family: Roboto Condensed; color: #280000">Proiect realizat de Negrut Maria-Daniela grupa 233 in cadrul cursului "Dezvoltarea Aplicatiilor Web in PHP" FMI Unibuc (2021)</p>
            <h1 style = "font-family: Zen Antique Soft; color: #E13700"class="display-1 font-weight-bolder">Centrul medical Sirona</h1>
        </div>
    </div>

    <nav style = "background-color: #6B6570" class="navbar sticky-top navbar-expand-lg navbar-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://negrutmariadaniela.infinityfreeapp.com/">Centrul medical Sirona</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" class="nav-link" href="/">Despre</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" class="nav-link" href="#">Rezultate analize</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" class="nav-link" href="#">Programare</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right justify-content-end">
         <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Contul meu</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item disabled">Conecteaza-te</a>
                    </div>
         </li>
        </ul>
        </div>
    </div>
    </nav>


    
    ';
}
function generate_page_lower()
{
  echo '
  <footer class="text-center text-lg-start bg-light text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-2 border-bottom"></section>
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <div class="d-flex justify-content-between row mt-3">
          <!-- Grid column -->
          <div class="col-md-4 col-lg-4 col-xl-3 mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3">Centrul medical Sirona</i>
            </h6>
            <p>Această pagină reprezintă un proiect la materia "Dezvoltarea Aplicațiilor Web în PHP" anul școlar 2021-2022. Datele prezente nu sunt reale.</br>Implentat folosind bootstrap.</p>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>
            <p> Negruț Maria-Daniela grupa 233</p>
            <p>Email: <a href="mailto:maria.negrut@s.unibuc.ro">maria.negrut@s.unibuc.ro</p></a>
            <p>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-1" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Footer Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
    </footer>';
}
?>
