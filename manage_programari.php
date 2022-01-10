<?php include_once 'data/header.php';

 if (session_status() != 2 || !isset($_SESSION['doctor']))
 {
   ?>
   <script type="text/javascript">
   window.location.href = './index.php';
   </script>
   <?php
 }

 if (isset($_POST['id_prog']))
 {
   $_SESSION['k_id_programare'] = $_POST['id_prog'];
   include_once('./data/getprogr.php');
   include_once('./data/cdb.inc.php');
   $aux = getIdFromProg($conn, $_SESSION['k_id_programare']);
   $_SESSION['k_id_pacient'] = $aux['id_pacient'];
   $_SESSION['k_data'] = $aux['data'];

   ?>
   <script type="text/javascript">
   window.location.href = './complprogr.php';
   </script>
   <?php
   exit();
 }
?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Completare procedură</h4>
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
            echo '</br><h6 class="text-danger">'.'Procedura completata cu succes.'.'</h6></br>';
        }

        include_once('./data/getprogr.php');
        include_once('./data/cdb.inc.php');
        $programari = getProgr($conn, $_SESSION['doctor']);
      ?>
      <div class="d-flex justify-content-center form-check">
        <form action="" method="post">
          <label class="form-check-label" for="id_prog"> <h6>Alegeti programarea </h6></label></br>
          <select name="id_prog">
            <?php foreach($programari as $val):?>
              <option value=<?=$val['id_programare']?>><?=$val['pacient']?></option>
            <?php endforeach;?>
          </select></br></br>
          <button class="btn btn-outline-secondary" type="submit" value="true" name="submitP">Mai departe</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
