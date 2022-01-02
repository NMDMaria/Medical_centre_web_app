<?php include_once 'data/header.php';
if (!isset($_SESSION['login'])) // cineva nelogat incearca sa itnre pe pagina
{
  ?>
  <script type="text/javascript">
  window.location.href = './index.php';
  </script>
  <?php
  exit();
}
if (isset($_SESSION['admin'])) // verificare daca utilizatorul este admin
{
  ?>
  <script type="text/javascript">
  window.location.href = './admin_homepage.php'; // adminii au alta pagina pt ca nu au
  // pagina cu nume prenume etc
  </script>
  <?php
  exit();
}
?>


<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Profilul tău</h4>
      <?php
            if (isset($_GET['error']))
            {
              $err = $_GET['error'];
              $msg = '';
              if ($err == 'emptyfield')
                $msg = "Un câmp nu a fost completat.";
              if ($err == 'notvalidmail')
                $msg = 'Email invalid.';
              if ($err == 'wrong')
                $msg = 'Ceva a mers prost :(. Încercați iar.';
              if ($msg !== '')
                echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
            }
      ?>
      <div>
        <?php
          include_once 'data/getProfile.inc.php';
          if ($result == [])
          {
            ?>
            <script type="text/javascript">
            window.location.href = './profile.php?error=wrong';
            </script>
            <?php
            exit();
          }
          // pentru a face formularul fie read-only fie editable avem var. ro = readonly
          if (!isset($_GET['edit']) || $_GET['edit'] != true) // daca nu e setat edit
              $ro = true;
          else if ($_GET['edit'] == true) // daca e setat edit nu mai e read only
              $ro = false;
        ?>
        <?php if($result['type'] == 'pacienti'): // varianta pacient?>
            <form action="data/edit_profile.inc.php" method="get">
            <label class="form-check-label" for="nume"> <h6>Nume</h6></label></br>
            <input class="form-control w-50" type="text" name="nume" placeholder=<?= $result['nume']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
            <label class="form-check-label" for="prenume"> <h6>Prenume</h6></label></br>
            <input class="form-control w-50" type="text" name="prenume" placeholder=<?= $result['prenume']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
            <label class="form-check-label" for="cnp"> <h6>CNP</h6></label></br>
            <input class="form-control w-50" type="text" name="cnp" placeholder=<?= $result['cnp']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
            <label class="form-check-label" for="dob"> <h6>Data nașterii</h6></label></br>
            <input class="form-control w-50" type="text" name="dob"placeholder=<?= $result['data_nasterii']?> onfocus="(this.type='date')" onblur="(this.type='text')"  <?= $ro ? 'readonly="true"' : '' ?>></br>
            <label class="form-check-label" for="gen"> <h6>Gen</h6></label></br>
            <input class="form-control w-50" type="text" name="gen" placeholder=<?= $result['gen']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <?php if ($ro == true) : //buton cu editare?>
            <button class="btn btn-outline-secondary" type="submit" value="true" name="edit">Edit</button>
          <?php elseif ($ro == false) : //buton cu accepta editare:?>
            <button class="btn btn-outline-secondary" type="submit" value="true" name="acc_edit">Accept edit</button>
          <?php endif;?>
          </form></br></br>
        <?php elseif ($result['type'] == 'angajati') : // varianta medic?>
          <form action="data/edit_profile.inc.php" method="get">
          <label class="form-check-label" for="nume"> <h6>Nume</h6></label></br>
          <input class="form-control w-50" type="text" name="nume" placeholder=<?= $result['nume']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="prenume"> <h6>Prenume</h6></label></br>
          <input class="form-control w-50" type="text" name="prenume" placeholder=<?= $result['prenume']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="cnp"> <h6>CNP</h6></label></br>
          <input class="form-control w-50" type="text" name="cnp" placeholder=<?= $result['cnp']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="dob"> <h6>Data nașterii</h6></label></br>
          <input class="form-control w-50" type="text" name="dob"placeholder=<?= $result['data_nasterii']?> onfocus="(this.type='date')" onblur="(this.type='text')" <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="doa"> <h6>Data angajării</h6></label></br>
          <input class="form-control w-50" type="text" name="doa"placeholder=<?= $result['data_angajarii']?> onfocus="(this.type='date')" onblur="(this.type='text')"  readonly="true"></br>
          <label class="form-check-label" for="nr_telefon"> <h6>Număr de telefon</h6></label></br>
          <input class="form-control w-50" type="text" name="nr_telefon" placeholder=<?= $result['nr_telefon']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="email"> <h6>Email personal</h6></label></br>
          <input class="form-control w-50" type="text" name="email" placeholder=<?= $result['email']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
          <label class="form-check-label" for="salariu"> <h6>Salariu</h6></label></br>
          <input class="form-control w-50" type="text" name="salariu" placeholder=<?= $result['salariu']?> readonly="true"></br>
          <label class="form-check-label" for="bonus"> <h6>Bonus</h6></label></br>
          <input class="form-control w-50" type="text" name="bonus" placeholder=<?= $result['bonus']?> readonly="true"></br>
          <label class="form-check-label" for="slujba"> <h6>Slujbă</h6></label></br>
          <input class="form-control w-50" type="text" name="slujba" placeholder="<?= $result['slujba']?>" readonly="true"></br>
          <?php if ($result['angajat_type'] == 'Personal_medical'): ?>
              <label class="form-check-label" for="domeniu"> <h6>Domeniu de activitate</h6></label></br>
              <input class="form-control w-50" type="text" name="domeniu" placeholder="<?= $result['domeniu']?>" readonly="true"></br>
              <label class="form-check-label" for="sediu"> <h6>Sediu</h6></label></br>
              <input class="form-control w-50" type="text" name="sediu" placeholder="<?= $result['sediu']?>" readonly="true"></br>
              <label class="form-check-label" for="cabinet"> <h6>Camera cabinet</h6></label></br>
                <input class="form-control w-50" type="text" name="cabinet" placeholder="<?= $result['cabinet'] ? $result['cabinet'] : 'Niciunul.'?>" readonly="true"></br>
          <?php endif; ?>
          </form></br></br>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
