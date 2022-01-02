<?php include_once 'data/header.php';
 if (session_status() != 2 || !isset($_SESSION['signup']) || $_SESSION['signup'] !== true)
 {
   ?>
   <script type="text/javascript">
   window.location.href = './index.php';
   </script>
   <?php
 }
?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Creare profil</h4>
      <?php
        if (isset($_GET['error']))
        {
          $err = $_GET['error'];
          $msg = '';
          if ($err == 'emptyfield')
            $msg = "Un câmp nu a fost completat.";
          if ($err == 'notvalidusername')
            $msg = "Username invalid.";
          if ($err == 'notvalidmail')
            $msg = 'Email invalid.';
          if ($err == 'usernotexists')
            $msg = 'Utilizatorul nu există. Verificați datele și încercați iar sau înregistrați-vă.';
          if ($err == 'wrong')
            $msg = 'Ceva a mers prost :(. Încercați iar.';
          if ($err == 'captcha')
            $msg = 'Captcha nu a fost validat. Încercați iar.';
          if ($err == 'cnpnotvalid')
              $msg = 'CNP-ul introdus este greșit. Verificați și încercați iar.';
          if ($msg !== '')
            echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
        }

        if (isset($_GET['succes']))
        {
          $type =  $_GET['succes'];
          $msg = '';
          if ($type == "assoc")
            $msg = "Așteptare validare asociere profil de către un admin. Încercați mai târziu.";
          if ($type == "create")
            $msg = "Aștepare validare creare profil de către un admin. Încercați mai târziu";
          if ($msg !== '')
            echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';

        }
      ?>
      <div class="form-check">
        <form action="data/request_doc_profile.inc.php" method="post">
          <label class="form-check-label" for="nume"> <h6>Nume</h6></label></br>
          <input class="form-control w-50" type="text" name="nume" placeholder="Nume"></br>
          <label class="form-check-label" for="prenume"> <h6>Prenume</h6></label></br>
          <input class="form-control w-50" type="text" name="prenume" placeholder="Prenume"></br>
          <label class="form-check-label" for="cnp"> <h6>CNP</h6></label></br>
          <input class="form-control w-50" type="text" name="cnp" placeholder="XXXXXXXXXX"></br>
          <label class="form-check-label" for="dob"> <h6>Data nașterii</h6></label></br>
          <input class="form-control w-50" type="date" name="dob"></br>
          <label class="form-check-label" for="nr_telefon"> <h6>Număr de telefon</h6></label></br>
          <input class="form-control w-50" type="text" name="nr_telefon" placeholder="07XXXXXXXX"></br>
          <label class="form-check-label" for="domeniu"> <h6>Domeniu</h6></label></br>
          <input class="form-control w-50" type="text" name="domeniu" placeholder="Domeniu"></br>
          <label class="form-check-label" for="email"> <h6>Email personal</h6></label></br>
          <input class="form-control w-50" type="email" name="email" placeholder="exemplu@sirona.com"></br>
          <div class="h-captcha" data-sitekey="8dcda850-d58a-4505-b899-338f7cc261ac"></div></br></br>
          <button class="btn btn-outline-secondary" type="submit" name="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
