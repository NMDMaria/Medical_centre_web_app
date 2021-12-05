<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="data/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <title>FMI PHP 2021 NMD233</title>
</head>

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
    <a class="navbar-brand" href="/">Centrul medical Sirona</a>
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
                  <?php
                  if (!isset($_SESSION['login']) || $_SESSION['login'] == false) : ?>
                    <a href="./login.php" class="dropdown-item">Conectare</a>
                    <a href="./signup.php" class="dropdown-item">Înregistrare</a>
                  <?php else :?>
                    <a href="./profile.php" class="dropdown-item">Profilul meu</a>
                    <a href="./data/disconnect.inc.php" class="dropdown-item">Deconectare</a>
                  <?php endif;?>
                </div>
     </li>
    </ul>
    </div>
</div>
</nav>
