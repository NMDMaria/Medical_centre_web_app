<?php
include_once('cdb.inc.php');

function implinita($conn, $id_progr)
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

function addOperatie($conn, $id_tip_operatie, $id_programare, $id_pacient)
{
  $sql = "insert into operatii(id_tip_operatie, id_programare, id_pacient) values (?, ?, ?);";
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

  mysqli_stmt_bind_param($stmt, "sii", $id_tip_operatie, $id_programare, $id_pacient);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

if (isset($_POST['submit']))
{
  addOperatie($conn, $_POST['id_op'], $_SESSION['k_id_programare'], $_SESSION['k_id_pacient']);
  implinita($conn, $_SESSION['k_id_programare']);
  unset($_SESSION['k_id_programare']);
  unset($_SESSION['k_id_pacient']);
  ?>
  <script type="text/javascript">
  window.location.href = '../complprogr.php?succes=o';
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
