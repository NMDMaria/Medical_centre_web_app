<?php include_once 'data/header.php';
  if (session_status() != 2 || !isset($_SESSION['signup']) || $_SESSION['signup'] !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = './index.php';
    </script>
    <?php
    exit();
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
              if ($err == 'missmatchpassword')
                $msg = 'Parolele nu se potrivesc.';
              if ($err == 'usernotexists')
                $msg = 'Utilizatorul nu există. Verificați datele și încercați iar sau înregistrați-vă.';
              if ($err == 'wrong')
                $msg = 'Ceva a mers prost :(. Încercați iar.';
              if ($err == 'cnpnotvalid')
                  $msg = 'CNP-ul introdus este greșit. Verificați și încercați iar.';
              if ($msg !== '')
                echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
            }
      ?>

      <div class="form-check">
        <form action="data/createprofile.inc.php" method="post">
          <label class="form-check-label" for="nume"> <h6>Nume</h6></label></br>
          <input class="form-control w-50" type="text" name="nume" placeholder="Nume"></br>
          <label class="form-check-label" for="prenume"> <h6>Prenume</h6></label></br>
          <input class="form-control w-50" type="text" name="prenume" placeholder="Prenume"></br>
          <label class="form-check-label" for="cnp"> <h6>CNP</h6></label></br>
          <input class="form-control w-50" type="text" name="cnp" placeholder="XXXXXXXXXX"></br>
          <label class="form-check-label" for="dob"> <h6>Data nașterii</h6></label></br>
          <input class="form-control w-50" type="date" name="dob"></br>
          <label class="form-check-label" for="gen"> <h6>Gen</h6></label></br>
          <select class="form-control w-50" name ="gen">
           <option>M</option>
           <option>F</option>
          </select></br>
          <button class="btn btn-outline-secondary" type="submit" name="submit">Submit</button>
        </form></br></br>

        <form action="doctorprofile.php" method="post">
          <div class ="d-flex justify-content-between">
            <label class="form-check-label" for="docprof"> <h6> Sunteți doctor membru?</h6></label>
            <button class="btn btn-outline-secondary" type="submit" name="docprof">Cereți profil de medic</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
