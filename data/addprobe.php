<?php
include_once('cdb.inc.php');
if (session_status() != 2) session_start();

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

function addProba($conn, $id_programare, $id_pacient, $tip)
{
  $sql = "insert into probe(id_pacient, id_programare, tip) values (?, ?, ?)";
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

  mysqli_stmt_bind_param($stmt, "iis", $id_pacient,  $id_programare, $tip);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

if (isset($_POST['submitR']))
{
  $sql = "insert into proceduri_medicale(id_programare, id_pacient, proceduri_medicale_type) values (?, ?, 'Recoltare')";
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

  if ($_POST['proba1'] != '')
    addProba($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $_POST['proba1']);
  if ($_POST['proba2'] != '')
    addProba($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $_POST['proba2']);
  if ($_POST['proba3'] != '')
    addProba($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $_POST['proba3']);
  if ($_POST['proba4'] != '')
    addProba($conn, $_SESSION['k_id_programare'], $_SESSION['k_id_pacient'], $_POST['proba4']);


  implinita($conn,  $_SESSION['k_id_programare']);
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
