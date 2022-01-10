<?php
include_once('cdb.inc.php');
if (session_status() != 2) session_start();

function addConsultatie($conn, $id_programare, $id_pacient, $motiv)
{
  $sql = "insert into proceduri_medicale(id_programare, id_pacient, proceduri_medicale_type) values (?, ?, 'Consult')";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_programare, $id_pacient);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);


  $sql = "insert into consultatii(id_programare, id_pacient, motiv) values (?, ?, null)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_programare, $id_pacient);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function addDiagnostic($conn, $id_programare, $id_pacient, $id_afectiune)
{
  $sql = "insert into diagnostice(id_pacient, id_programare, id_afectiune) values (?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "iis", $id_pacient, $id_programare, $id_afectiune);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function addTratament($conn, $id_medicament, $data, $durata, $unitati, $id_programare, $id_afectiune, $id_pacient)
{
  $sql = "insert into tratamente values(?, date(?), ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }
  mysqli_stmt_bind_param($stmt, "isisisi", $id_medicament, $data, $durata, $unitati, $id_programare, $id_afectiune, $id_pacient);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function addTrimitere($conn, $id_programare, $id_afectiune, $id_pacient, $specializare, $motiv)
{
  $sql = "insert into trimiteri(id_pacient, id_programare, id_afectiune, specializare, motiv) values(?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "iisss", $id_pacient, $id_programare, $id_afectiune, $specializare, $motiv);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function implinita($conn, $id_programare)
{
  $sql = "update programari set status = 'Implinita' where id_programare = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_programare);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

if (isset($_POST['submit']))
{
  $motiv = '';
  if (isset($_POST['motiv']))
    $motiv = mysqli_real_escape_string($conn, $_POST['motiv']);

  addConsultatie($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $motiv);
  if (isset($_POST['id_af']) && $_POST['id_af'] != '')
  {
    addDiagnostic($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $_POST['id_af']);
    if (isset($_POST['id_medic1']) && $_POST['id_medic1'] != '')
    {
      $durata = mysqli_real_escape_string($conn,$_POST['zi1']);
      $unit = trim(mysqli_real_escape_string($conn,$_POST['unit1']));
      addTratament($conn, $_POST['id_medic1'], $_SESSION['k_data'], $durata, $unit, $_SESSION['k_id_programare'], $_POST['id_af'], $_SESSION['k_id_pacient']);
    }

    if (isset($_POST['id_medic2']) && $_POST['id_medic2'] != '')
    {
      $durata = mysqli_real_escape_string($conn,$_POST['zi2']);
      $unit = trim(mysqli_real_escape_string($conn,$_POST['unit2']));
      addTratament($conn, $_POST['id_medic2'], $_SESSION['k_data'], $durata, $unit, $_SESSION['k_id_programare'], $_POST['id_af'], $_SESSION['k_id_pacient']);
    }

    if (isset($_POST['id_medic3']) && $_POST['id_medic3'] != '')
    {
      $durata = mysqli_real_escape_string($conn,$_POST['zi3']);
      $unit = trim(mysqli_real_escape_string($conn,$_POST['unit3']));
      addTratament($conn, $_POST['id_medic3'], $_SESSION['k_data'], $durata, $unit, $_SESSION['k_id_programare'], $_POST['id_af'], $_SESSION['k_id_pacient']);
    }

    if (isset($_POST['id_medic4']) && $_POST['id_medic4'] != '')
    {
      $durata = mysqli_real_escape_string($conn,$_POST['zi4']);
      $unit = trim(mysqli_real_escape_string($conn,$_POST['unit4']));
      addTratament($conn, $_POST['id_medic4'], $_SESSION['k_data'], $durata, $unit, $_SESSION['k_id_programare'], $_POST['id_af'], $_SESSION['k_id_pacient']);
    }

    if (isset($_POST['id_medic5']) && $_POST['id_medic5'] != '')
    {
      $durata = mysqli_real_escape_string($conn,$_POST['zi5']);
      $unit = trim(mysqli_real_escape_string($conn,$_POST['unit5']));
      addTratament($conn, $_POST['id_medic5'], $durata, $unit, $_SESSION['k_id_programare'], $_POST['id_af'], $_SESSION['k_id_pacient']);
    }

    if (isset($_POST['trim_spec1']) && trim($_POST['trim_spec1'] != ''))
    {
      $specializare = trim(mysqli_real_escape_string($conn,$_POST['trim_spec1']));
      $motiv = '';
      if (isset($_POST['trim_motiv1']) && trim($_POST['trim_motiv1'] != ''))
        $motiv =  trim(mysqli_real_escape_string($conn,$_POST['trim_motiv1']));
      addTrimitere($conn, $_SESSION['k_id_programare'], $_POST['id_af'],  $_SESSION['k_id_pacient'], $specializare, $motiv);
    }

    if (isset($_POST['trim_spec2']) && trim($_POST['trim_spec2'] != ''))
    {
      $specializare = trim(mysqli_real_escape_string($conn,$_POST['trim_spec2']));
      $motiv = '';
      if (isset($_POST['trim_motiv2']) && trim($_POST['trim_motiv2'] != ''))
        $motiv =  trim(mysqli_real_escape_string($conn,$_POST['trim_motiv2']));
      addTrimitere($conn, $_SESSION['k_id_programare'], $_POST['id_af'],  $_SESSION['k_id_pacient'], $specializare, $motiv);
    }

    if (isset($_POST['trim_spec3']) && trim($_POST['trim_spec3'] != ''))
    {
      $specializare = trim(mysqli_real_escape_string($conn,$_POST['trim_spec3']));
      $motiv = '';
      if (isset($_POST['trim_motiv3']) && trim($_POST['trim_motiv3'] != ''))
        $motiv =  trim(mysqli_real_escape_string($conn,$_POST['trim_motiv3']));
      addTrimitere($conn, $_SESSION['k_id_programare'], $_POST['id_af'],  $_SESSION['k_id_pacient'], $specializare, $motiv);
    }

    if (isset($_POST['trim_spec4']) && trim($_POST['trim_spec4'] != ''))
    {
      $specializare = trim(mysqli_real_escape_string($conn,$_POST['trim_spec4']));
      $motiv = '';
      if (isset($_POST['trim_motiv4']) && trim($_POST['trim_motiv4'] != ''))
        $motiv =  trim(mysqli_real_escape_string($conn,$_POST['trim_motiv4']));
      addTrimitere($conn, $_SESSION['k_id_programare'], $_POST['id_af'],  $_SESSION['k_id_pacient'], $specializare, $motiv);
    }

    if (isset($_POST['trim_spec5']) && trim($_POST['trim_spec5'] != ''))
    {
      $specializare = trim(mysqli_real_escape_string($conn,$_POST['trim_spec5']));
      $motiv = '';
      if (isset($_POST['trim_motiv5']) && trim($_POST['trim_motiv5'] != ''))
        $motiv =  trim(mysqli_real_escape_string($conn,$_POST['trim_motiv5']));
      addTrimitere($conn, $_SESSION['k_id_programare'], $_POST['id_af'],  $_SESSION['k_id_pacient'], $specializare, $motiv);
    }

  }

  implinita($conn, $_SESSION['k_id_programare']);

  unset($_SESSION['k_id_programare']);
  unset($_SESSION['k_id_pacient']);
  ?>
  <script type="text/javascript">
  window.location.href = '../manage_programari.php?succes=c';
  </script>
  <?php
  exit();

}
else
{
  ?>
  <script type="text/javascript">
  window.location.href = '../index.php';
  </script>
  <?php
  exit();
}
