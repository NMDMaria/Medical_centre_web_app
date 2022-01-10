<?php include_once 'data/header.php';

 if (session_status() != 2 || !isset($_SESSION['doctor']))
 {
   ?>
   <script type="text/javascript">
   window.location.href = './index.php';
   </script>
   <?php
 }

 if (!isset($_SESSION['k_id_programare']) || !isset($_SESSION['k_id_pacient']))
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
      ?>
      <?php
      if (!isset($_POST['tip'])):
      ?>
      <div class="form-check">
        <form action="" method="post">
          <label class="form-check-label" for="doc"> <h6>Tipul procedurii: </h6></label></br>
          <select name="tip">
              <option value='o'>Operatie</option>
              <option value='c'>Consult</option>
              <option value='r'>Recoltare</option>
          </select></br></br>
          <button class="btn btn-outline-secondary" type="submit" value="true" name="submit">Mai departe</button>
        </form>
      </div>
    <?php elseif ($_POST['tip'] == 'o'):
      include('./data/getProceduri.php');?>
      <div class="form-check">
        <form action="./data/addop.php" method="post">
          <label class="form-check-label" for="id_op"> <h6>Tipul operatiei </h6></label></br>
          <select name="id_op">
            <?php foreach($operatii as $val):?>
              <option value=<?=$val['id_tip_operatie']?>><?=$val['denumire']?></option>
            <?php endforeach;?>
          </select></br></br>
          <button class="btn btn-outline-secondary" type="submit" value="true" name="submitAd">Mai departe</button>
        </form>
      </div>
    <?php elseif ($_POST['tip'] == 'c'):
      include('./data/getProceduri.php');?>
      <div class="form-check">
        <form class="d-flex flex-row justify-content-between" action="./data/addcons.php" method="post">
          <div class="p-2">
            <label class="form-check-label" for="motiv"> <h6>Motiv</h6></label></br>
            <input type="text" name="motiv" placeholder="Nu este obligatoriu..."></br></br>
            <label class="form-check-label" for="id_af"> <h6>Diagnostic</h6></label></br>
            <select name="id_af">
              <option value="">Fara diagnostic</option>
              <?php foreach($afectiuni as $val):?>
                <option value=<?=$val['id_afectiune']?>><?=$val['denumire_afectiune']?></option>
              <?php endforeach;?>
            </select></br>
            </br></br>
          </div>
          <div class="p-2">
            <label class="form-check-label"> <h5>Tratament</h5></label></br>
            <label class="form-check-label"> <h6>Medicament: </h6></label></br>
            <select name="id_medic1">
              <option value="">Fara diagnostic</option>
              <?php foreach($medicamente as $val):?>
                <option value=<?=$val['id_medicament']?>><?=$val['denumire']?></option>
              <?php endforeach;?>
            </select></br></br>
            <label class="form-check-label" for="zi1"> <h6>Numarul de zile:</h6></label></br>
            <input type="number" name="zi1" min="0" max="30"></br></br>
            <label class="form-check-label" for="unit1"> <h6>Unitati indicate per zi:</h6></label></br>
            <input type="text" name="unit1"></br></br>
            </br></br>
            <label class="form-check-label"> <h6>Medicament: </h6></label></br>
            <select name="id_medic2">
              <option value="">Fara diagnostic</option>
              <?php foreach($medicamente as $val):?>
                <option value=<?=$val['id_medicament']?>><?=$val['denumire']?></option>
              <?php endforeach;?>
            </select></br></br>
            <label class="form-check-label" for="zi2"> <h6>Numarul de zile:</h6></label></br>
            <input type="number" name="zi2" min="0" max="30"></br></br>
            <label class="form-check-label" for="unit2"> <h6>Unitati indicate per zi:</h6></label></br>
            <input type="text" name="unit2"></br></br>
            <label class="form-check-label"> <h6>Medicament: </h6></label></br>
            <select name="id_medic3">
              <option value="">Fara diagnostic</option>
              <?php foreach($medicamente as $val):?>
                <option value=<?=$val['id_medicament']?>><?=$val['denumire']?></option>
              <?php endforeach;?>
            </select></br></br>
            <label class="form-check-label" for="zi3"> <h6>Numarul de zile:</h6></label></br>
            <input type="number" name="zi3" min="0" max="30"></br></br>
            <label class="form-check-label" for="unit3"> <h6>Unitati indicate per zi:</h6></label></br>
            <input type="text" name="unit3"></br></br>
            <label class="form-check-label"> <h6>Medicament: </h6></label></br>
            <select name="id_medic4">
              <option value="">Fara diagnostic</option>
              <?php foreach($medicamente as $val):?>
                <option value=<?=$val['id_medicament']?>><?=$val['denumire']?></option>
              <?php endforeach;?>
            </select></br></br>
            <label class="form-check-label" for="zi4"> <h6>Numarul de zile:</h6></label></br>
            <input type="number" name="zi4" min="0" max="30"></br></br>
            <label class="form-check-label" for="unit4"> <h6>Unitati indicate per zi:</h6></label></br>
            <input type="text" name="unit4"></br></br>
            <label class="form-check-label"> <h6>Medicament: </h6></label></br>
            <select name="id_medic5">
              <option value="">Fara diagnostic</option>
              <?php foreach($medicamente as $val):?>
                <option value=<?=$val['id_medicament']?>><?=$val['denumire']?></option>
              <?php endforeach;?>
            </select></br></br>
            <label class="form-check-label" for="zi5"> <h6>Numarul de zile:</h6></label></br>
            <input type="number" name="zi5" min="0" max="30"></br></br>
            <label class="form-check-label" for="unit5"> <h6>Unitati indicate per zi:</h6></label></br>
            <input type="text" name="unit5"></br></br>
          </div>
          <div class="p-2">
            <label class="form-check-label"> <h5>Trimitere</h5></label></br>
            <label class="form-check-label" for="trim_spec1"> <h6>Specializare</h6></label></br>
            <input type="text" name="trim_spec1"></br>
            <label class="form-check-label" for="trim_motiv1"> <h6>Motiv</h6></label></br>
            <input type="text" name="trim_motiv1"></br></br>
            <label class="form-check-label" for="trim_spec2"> <h6>Specializare</h6></label></br>
            <input type="text" name="trim_spec2"></br>
            <label class="form-check-label" for="trim_motiv2"> <h6>Motiv</h6></label></br>
            <input type="text" name="trim_motiv3"></br></br>
            <label class="form-check-label" for="trim_spec3"> <h6>Specializare</h6></label></br>
            <input type="text" name="trim_spec3"></br>
            <label class="form-check-label" for="trim_motiv3"> <h6>Motiv</h6></label></br>
            <input type="text" name="trim_motiv4"></br></br>
            <label class="form-check-label" for="trim_spec4"> <h6>Specializare</h6></label></br>
            <input type="text" name="trim_spec4"></br>
            <label class="form-check-label" for="trim_motiv4"> <h6>Motiv</h6></label></br>
            <input type="text" name="trim_motiv5"></br></br>
            <label class="form-check-label" for="trim_spec5"> <h6>Specializare</h6></label></br>
            <input type="text" name="trim_spec5"></br>
            <label class="form-check-label" for="trim_motiv5"> <h6>Motiv</h6></label></br>
            <input type="text" name="trim_motiv5"></br></br>
          </div>
          <div>
            <button class="btn btn-outline-secondary" type="submit" value="true" name="submit">Mai departe</button>
          </div>
        </form>
      </div>
    <?php elseif($_POST['tip'] == 'r'):?>
      <div class="form-check">
        <form action="./data/addprobe.php" method="post">
          <label class="form-check-label" for="proba1"> <h6> Tipul probei </h6></label></br>
          <select name="proba1">
            <option value=""></option>
            <option value="Urocultura">Urocultura</option>
            <option value="Sange">Sange</option>
            <option value="Coprocultura">Coprocultura</option>
            <option value="Lingual">Lingual</option>
          </select></br></br>
          <label class="form-check-label" for="proba2"> <h6> Tipul probei </h6></label></br>
          <select name="proba2">
            <option value=""></option>
            <option value="Urocultura">Urocultura</option>
            <option value="Sange">Sange</option>
            <option value="Coprocultura">Coprocultura</option>
            <option value="Lingual">Lingual</option>
          </select></br></br>
          <label class="form-check-label" for="proba3"> <h6> Tipul probei </h6></label></br>
          <select name="proba3">
            <option value=""></option>
            <option value="Urocultura">Urocultura</option>
            <option value="Sange">Sange</option>
            <option value="Coprocultura">Coprocultura</option>
            <option value="Lingual">Lingual</option>
          </select></br></br>
          <label class="form-check-label" for="proba4"> <h6> Tipul probei </h6></label></br>
          <select name="proba4">
            <option value=""></option>
            <option value="Urocultura">Urocultura</option>
            <option value="Sange">Sange</option>
            <option value="Coprocultura">Coprocultura</option>
            <option value="Lingual">Lingual</option>
          </select></br></br>
          <button class="btn btn-outline-secondary" type="submit" value="true" name="submitR">Mai departe</button>
        </form>
      </div>
    <?php endif;?>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
