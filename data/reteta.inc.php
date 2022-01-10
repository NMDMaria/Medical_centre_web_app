<?php
function getTr($conn, $id_pacient, $id_programare)
{
  $sql = "SELECT t.data_incepere, p.data, t.durata, t.unitati_zi, m.denumire FROM tratamente t join medicamente m on (m.id_medicament=t.id_medicament) join programari p on (t.id_programare = p.id_programare) where t.id_pacient = ? and t.id_programare = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../istoric.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_pacient,  $id_programare);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $row;

  mysqli_stmt_close($stmt);
}

function getPac($conn, $id_pacient)
{
  $sql = "select *, FLOOR((TIMESTAMPDIFF(MONTH, data_nasterii, CURDATE()) / 12)) varsta from pacienti where id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../istoric.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_pacient);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_assoc($result);
  return $row;

  mysqli_stmt_close($stmt);
}

function getDoc($conn, $id_programare)
{
  $sql = "select d.nume, d.prenume from angajati d join programari p on (p.id_doctor = d.id_angajat) where p.id_programare = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../istoric.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_programare);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_assoc($result);
  return $row;

  mysqli_stmt_close($stmt);
}


function getDiag($conn, $id_programare)
{
  $sql = "select p.data, a.denumire_afectiune from programari p join diagnostice d on (p.id_programare = d.id_programare) join afectiuni a on (d.id_afectiune = a.id_afectiune) where p.id_programare = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../istoric.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_programare);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_assoc($result);
  return $row;

  mysqli_stmt_close($stmt);
}
