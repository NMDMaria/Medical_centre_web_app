<?php
include_once 'data/header.php';
include_once 'data/grab.inc.php';
// se incearca intreare pe pagina nelogat/nu admin/ nu din buton
if (session_statust() != 2 ) session_start();
if (session_status() !=2 || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1 || !isset($_SESSION['crprf']))
{
  ?>
  <script type="text/javascript">
  window.location.href = './index.php';
  </script>
  <?php
  exit();
}

$result = grabTempAng($conn, $_SESSION['crprf']); // preluare date angajat
$sljb = grabSlujbe($conn); // preluare lista slujbe
$sedii = grabSedii($conn); // preluare lista sedii
$_SESSION['result'] = $result;
?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Completați profilul doctorului</h4>
      <?php
            if (isset($_GET['error']))
            {
              $err = $_GET['error'];
              $msg = '';
              if ($err == 'wrong')
                $msg = 'Ceva a mers prost :(. Încercați iar.';
              if ($err == 'empty')
                $msg = 'Un câmp a fost lăsat necompletat.';
              if ($msg !== '')
                echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
            }
      ?>
      <div>
        <form action="data/grab.inc.php" method="post">
        <label class="form-check-label" for="nume"> <h6>Nume</h6></label></br>
        <input class="form-control w-50" type="text" name="nume" value=<?= $result['nume']?>></br>
        <label class="form-check-label" for="prenume"> <h6>Prenume</h6></label></br>
        <input class="form-control w-50" type="text" name="prenume" value=<?= $result['prenume']?>></br>
        <label class="form-check-label" for="cnp"> <h6>CNP</h6></label></br>
        <input class="form-control w-50" type="text" name="cnp" value=<?= $result['cnp']?>></br>
        <label class="form-check-label" for="dob"> <h6>Data nașterii</h6></label></br>
        <input class="form-control w-50" type="text" name="dob" value=<?= $result['data_nasterii']?> onfocus="(this.type='date')" onblur="(this.type='text')"></br>
        <label class="form-check-label" for="doa"> <h6>Data angajării</h6></label></br>
        <input class="form-control w-50" type="text" name="doa" onfocus="(this.type='date')" onblur="(this.type='text')"></br>
        <label class="form-check-label" for="nr_telefon"> <h6>Număr de telefon</h6></label></br>
        <input class="form-control w-50" type="text" name="nr_telefon" value=<?= $result['nr_telefon']?>></br>
        <label class="form-check-label" for="email"> <h6>Email personal</h6></label></br>
        <input class="form-control w-50" type="text" name="email" value=<?= $result['email']?>></br>
        <label class="form-check-label" for="salariu"> <h6>Salariu</h6></label></br>
        <input class="form-control w-50" type="text" name="salariu" placeholder='Completati!'></br>
        <label class="form-check-label" for="bonus"> <h6>Bonus</h6></label></br>
        <input class="form-control w-50" type="text" name="bonus" placeholder='Completati!' ></br>
        <label class="form-check-label" for="slujba"> <h6>Slujbă</h6></label></br>
        <select class="form-control w-50" name="slujba">
           <?php foreach($sljb as $curr_sl): // afisare dinamica a elementelor din baza de date?>
             <option value="<?=$curr_sl['id_slujba']?>"><?=$curr_sl['nume_slujba']?></option>
           <?php endforeach;?>
        </select>
        </br>
        <?php if ($result['angajat_type'] == 'Personal_medical'): ?>
          <label class="form-check-label" for="domeniu"> <h6>Domeniu de activitate</h6></label></br>
          <input class="form-control w-50" type="text" name="domeniu" value=<?= $result['domeniu']?>></br>
          <label class="form-check-label" for="sediu"> <h6>Sediu</h6></label></br>
          <select class="form-control w-50" name="sediu">
             <?php foreach($sedii as $curr_sed): // afisare dinamica a elementelor din baza de date?>
               <option value="<?=$curr_sed['id_sediu']?>"><?=$curr_sed['denumire_sediu']?></option>
             <?php endforeach;?>
          </select></br>
        <?php endif; ?>
        <button class="btn btn-outline-secondary" type="submit" value="true" name="yes">Accept</button>
        <button class="btn btn-outline-secondary" type="submit" value="true" name="no">Reject</button>
      </form>
    </div>
</div>


<?php include_once 'data/footer.php';?>
