<?php include_once 'data/header.php'; ?>
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
              if ($msg !== '')
                echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
            }
            else {
              if (session_status() != 2) session_start();
              if (isset($_SESSION['updateSomething']) && $_SESSION['updateSomething'] == true)
              {
                echo '</br><h6 class="text-danger">'.'Modificările au fost efectuate cu succes.'.'</h6></br>';
              }
              $_SESSION['updateSomething'] = false;
            }
            ?>
            <div>
              <?php  include_once 'data/getProfile.inc.php';
              //echo $_SESSION['admin'];
              if (isset($_SESSION['admin']))
              {
                echo $_SESSION['admin'];
                exit();
                header("location: /admin_homepage.php");;
              }
              if ($result == [])
                header("location: ../profile.php?error=wrong");
              if (!isset($_GET['edit']) || $_GET['edit'] != true)
                $ro = true;
              else if ($_GET['edit'] == true)
                  $ro = false;
              ?>
              <?php if($result['type'] == 'pacienti'): ?>
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
                  <?php if ($ro == true) : ?>
                  <button class="btn btn-outline-secondary" type="submit" value="true" name="edit">Edit</button>
                  <?php elseif ($ro == false) :?>
                  <button class="btn btn-outline-secondary" type="submit" value="true" name="acc_edit">Accept edit</button>
                  <?php endif;?>
                  </form></br></br>
              <?php elseif ($result['type'] == 'angajati') :?>
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
                    <input class="form-control w-50" type="text" name="sediu" placeholder="<?= $result['sediu']?>" <?= $ro ? 'readonly="true"' : '' ?>></br
                    <?php if($result['cabinet'] != 'NULL' && (!isset($_GET['edit']) || $_GET['edit'] !== true)): ?>
                      <label class="form-check-label" for="cabinet"> <h6>Camera cabinet</h6></label></br>
                      <input class="form-control w-50" type="text" name="cabinet" placeholder=<?= $result['cabinet']?> <?= $ro ? 'readonly="true"' : '' ?>></br>
                    <?php elseif (isset($_GET['edit']) && $_GET['edit'] == true) :?>
                      <label class="form-check-label" for="cabinet"> <h6>Camera cabinet</h6></label></br>
                      <input class="form-control w-50" type="text" name="cabinet" placeholder="Numărul camerei"> <?= $ro ? 'readonly="true"' : '' ?>></br>
                    <?php endif;?>
                  <?php endif; ?>
                  <?php if ($ro == true) : ?>
                  <button class="btn btn-outline-secondary" type="submit" value="true" name="edit">Edit</button>
                  <?php elseif ($ro == false) :?>
                  <button class="btn btn-outline-secondary" type="submit" value="true" name="acc_edit">Accept edit</button>
                  <?php endif;?>
              <?php endif;?>
              </form></br></br>
          </div>
        </div>
    </div>
</div>
<?php include_once 'data/footer.php';?>
